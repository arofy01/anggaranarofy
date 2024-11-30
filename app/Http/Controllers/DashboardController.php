<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnggaran = Anggaran::sum('nominal');
        $totalPengeluaran = Pengeluaran::sum('jumlah');
        $sisaAnggaran = $totalAnggaran - $totalPengeluaran;

        $pengeluarans = Pengeluaran::latest()->take(5)->get();

        return view('dashboard.index', compact('sisaAnggaran', 'pengeluarans'));
    }
}
