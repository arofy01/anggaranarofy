<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Logika untuk menampilkan laporan
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        if ($tanggalAwal && $tanggalAkhir) {
            $reports = Pengeluaran::with('admin', 'anggaran')
                ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
                ->get();
        } else {
            $reports = Pengeluaran::with('admin', 'anggaran')->get();
        }

        return view('report.index', compact('reports', 'tanggalAwal', 'tanggalAkhir'));
    }

    public function create()
    {
        return view('report.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pengeluaran' => 'required|string|max:255',
            'admin_id' => 'required|exists:admins,id',
            'jumlah' => 'required|numeric|min:0',
            'anggarans_id' => 'required|exists:anggarans,id',
        ]);

        // Simpan data ke tabel pengeluaran
        Pengeluaran::create([
            'nama_pengeluaran' => $request->input('nama_pengeluaran'),
            'admin_id' => $request->input('admin_id'),
            'jumlah' => $request->input('jumlah'),
            'anggarans_id' => $request->input('anggarans_id'),
        ]);

        return redirect()->route('report.index')->with('success', 'Laporan berhasil ditambahkan!');
    }
    
}
