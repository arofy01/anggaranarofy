<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            $reports = Pengeluaran::whereBetween('created_at', [$start_date, $end_date])
                ->orderBy('tahun', 'desc')
                ->get();
        } else {
            $reports = Pengeluaran::orderBy('tahun', 'desc')->get();
        }

        return view('report.index', compact('reports', 'start_date', 'end_date'));
    }

    public function create()
    {
        $tahunSekarang = date('Y');
        $tahunList = range($tahunSekarang - 5, $tahunSekarang + 5);
        return view('report.create', compact('tahunList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2000|max:2099',
            'nama_pengeluaran' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        Pengeluaran::create([
            'tahun' => $request->tahun,
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'keterangan' => $request->keterangan,
            'nominal' => $request->nominal,
        ]);

        return redirect()->route('report.index')
            ->with('success', 'Laporan berhasil ditambahkan!');
    }

    public function show(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        if (!$pengeluaran) {
            return redirect()->route('report.index')
                ->with('error', 'Laporan tidak ditemukan.');
        }
        return view('report.show', compact('pengeluaran'));
    }

    public function exportPDF(Request $request)
    {
        try {
            \Log::info('Starting PDF export', ['request' => $request->all()]);
            
            // If specific report ID is provided
            if ($request->has('id')) {
                \Log::info('Exporting single report', ['id' => $request->id]);
                $report = Pengeluaran::findOrFail($request->id);
                $reports = collect([$report]); // Convert single report to collection
            }
            // Filter by date if provided
            else if ($request->filled(['start_date', 'end_date'])) {
                \Log::info('Exporting with date filter', [
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date
                ]);
                
                $reports = Pengeluaran::whereBetween('created_at', [
                    $request->start_date . ' 00:00:00',
                    $request->end_date . ' 23:59:59'
                ])
                ->orderBy('tahun', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
            }
            // Get all reports if no filters
            else {
                \Log::info('Exporting all reports');
                $reports = Pengeluaran::orderBy('tahun', 'desc')
                               ->orderBy('created_at', 'desc')
                               ->get();
            }

            \Log::info('Found reports', ['count' => $reports->count()]);

            if ($reports->isEmpty()) {
                return back()->with('error', 'Tidak ada data untuk diekspor ke PDF.');
            }

            $data = [
                'reports' => $reports,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'single_report' => $request->has('id')
            ];

            \Log::info('Loading PDF view with data', ['data' => $data]);
            $pdf = \PDF::loadView('report.export-pdf', $data);
            $pdf->setPaper('A4', 'portrait');

            $filename = $request->has('id') 
                ? 'laporan-pengeluaran-' . $reports->first()->id . '.pdf'
                : 'laporan-pengeluaran-' . now()->format('Y-m-d') . '.pdf';

            return $pdf->download($filename);
        } catch (\Exception $e) {
            \Log::error('Error generating PDF: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat membuat PDF. Silakan coba lagi.');
        }
    }
}
