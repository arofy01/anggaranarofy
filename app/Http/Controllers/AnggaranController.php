<?php
namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    public function index()
    {
        $anggarans = Anggaran::all();
        return view('anggaran.index', compact('anggarans'));
    }

    public function create()
    {
        return view('anggaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer',
            'nama_anggaran' => 'required|string|max:255',
            'sumber' => 'required|string|max:255',
            'nominal' => 'required|numeric',
        ]);

        Anggaran::create($request->all());

        return redirect()->route('anggaran.index')->with('success', 'Anggaran berhasil ditambahkan!');
    }

    public function show(Anggaran $anggaran)
    {
        return view('anggaran.show', compact('anggaran'));
    }

    public function edit(Anggaran $anggaran)
    {
        return view('anggaran.edit', compact('anggaran'));
    }

    public function update(Request $request, Anggaran $anggaran)
    {
        $request->validate([
            'tahun' => 'required|integer',
            'nama_anggaran' => 'required|string|max:255',
            'sumber' => 'required|string|max:255',
            'nominal' => 'required|numeric',
        ]);

        $anggaran->update($request->all());

        return redirect()->route('anggaran.index')->with('success', 'Anggaran berhasil diperbarui!');
    }

    public function destroy(Anggaran $anggaran)
    {
        $anggaran->delete();

        return redirect()->route('anggaran.index')->with('success', 'Anggaran berhasil dihapus!');
    }
}
