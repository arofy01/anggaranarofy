<?php
namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Admin;
use App\Models\Anggaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::orderBy('tahun', 'desc')->get();
        return view('pengeluaran.index', compact('pengeluarans'));
    }

    public function create()
    {
        $tahunSekarang = date('Y');
        $tahunList = range($tahunSekarang - 5, $tahunSekarang + 5);
        
        // Get anggaran data for all years
        $anggaranList = Anggaran::all()->groupBy('tahun')->map(function ($items) {
            return [
                'total' => $items->sum('nominal'),
                'used' => Pengeluaran::where('tahun', $items->first()->tahun)->sum('nominal')
            ];
        });

        return view('pengeluaran.create', compact('tahunList', 'anggaranList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2000|max:2099',
            'nama_pengeluaran' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'nominal' => 'required|string|regex:/^\d+$/',
        ]);

        // Bersihkan format nominal
        $nominal = str_replace('.', '', $request->nominal);

        // Validasi terhadap sisa anggaran
        $totalAnggaran = Anggaran::where('tahun', $request->tahun)->sum('nominal');
        $totalPengeluaran = Pengeluaran::where('tahun', $request->tahun)->sum('nominal');
        $sisa = $totalAnggaran - $totalPengeluaran;

        if ($nominal > $sisa) {
            return back()
                ->withInput()
                ->withErrors(['nominal' => 'Nominal melebihi sisa anggaran yang tersedia (Rp ' . number_format($sisa, 0, ',', '.') . ')']);
        }

        Pengeluaran::create([
            'tahun' => $request->tahun,
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'keterangan' => $request->keterangan,
            'nominal' => $nominal,
            'admin_id' => auth()->id(),
        ]);

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan!');
    }

    public function show(Pengeluaran $pengeluaran)
    {
        return view('pengeluaran.show', compact('pengeluaran'));
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        $tahunSekarang = date('Y');
        $tahunList = range($tahunSekarang - 5, $tahunSekarang + 5);
        return view('pengeluaran.edit', compact('pengeluaran', 'tahunList'));
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2000|max:2099',
            'nama_pengeluaran' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'nominal' => 'required|string|regex:/^\d+$/', // Changed to string validation with digits only
        ]);

        // Bersihkan format nominal (hapus titik sebagai pemisah ribuan)
        $nominal = str_replace('.', '', $request->nominal);

        $pengeluaran->update([
            'tahun' => $request->tahun,
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'keterangan' => $request->keterangan,
            'nominal' => $nominal,
        ]);

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil diperbarui!');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil dihapus!');
    }
}
