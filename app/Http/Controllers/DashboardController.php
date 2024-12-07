<?php
namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Pengeluaran;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnggaran = Anggaran::sum('nominal'); // Total anggaran
        $totalPengeluaran = Pengeluaran::sum('jumlah'); // Total pengeluaran
        $anggaranTerpakai = $totalAnggaran > 0 ? ($totalPengeluaran / $totalAnggaran) * 100 : 0; // Persentase penggunaan anggaran

        return view('dashboard.index', compact('totalAnggaran', 'totalPengeluaran', 'anggaranTerpakai'));
        
    }
}
