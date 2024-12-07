<?php
namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Admin;
use App\Models\Anggaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    // Menampilkan daftar pengeluaran
    public function index()
    {
        $pengeluarans = Pengeluaran::with('admin', 'anggaran')->get(); // Ambil data pengeluaran dengan relasi
        return view('pengeluaran.index', compact('pengeluarans'));
    }

    // Menampilkan form tambah pengeluaran
    public function create()
    {
        $admins = Admin::all(); // Data admin untuk dropdown
        $anggarans = Anggaran::all(); // Data anggaran untuk dropdown
        return view('pengeluaran.create', compact('admins', 'anggarans'));
    }

    // Menyimpan data pengeluaran
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengeluaran' => 'required|string|max:255',
            'admin_id' => 'required|exists:admins,id',
            'jumlah' => 'required|numeric|min:0',
            'anggarans_id' => 'required|exists:anggarans,id',
        ]);

        Pengeluaran::create([
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'admin_id' => $request->admin_id,
            'jumlah' => $request->jumlah,
            'anggarans_id' => $request->anggarans_id,
        ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan!');
    }

    // Menampilkan detail pengeluaran (opsional)
    public function show(Pengeluaran $pengeluaran)
    {
        return view('pengeluaran.show', compact('pengeluaran'));
    }

    // Menampilkan form edit pengeluaran (opsional)
    public function edit($id)
{
    $pengeluaran = Pengeluaran::findOrFail($id); // Pastikan model ditemukan
    $anggarans = Anggaran::all(); // Ambil data anggaran jika perlu untuk dropdown

    return view('pengeluaran.edit', compact('pengeluaran', 'anggarans'));
}

    
public function update(Request $request, $id)
{
    $request->validate([
        'nama_pengeluaran' => 'required|string|max:255',
        'jumlah' => 'required|numeric|min:1',
        'anggaran_id' => 'required|exists:anggarans,id',
    ]);

    $pengeluaran = Pengeluaran::findOrFail($id);
    $pengeluaran->update([
        'nama_pengeluaran' => $request->nama_pengeluaran,
        'jumlah' => $request->jumlah,
        'anggaran_id' => $request->anggaran_id,
    ]);

    return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil diperbarui.');
}

    
    

    // Menghapus pengeluaran
    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil dihapus!');
    }
    
}
