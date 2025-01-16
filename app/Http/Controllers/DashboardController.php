<?php
namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total anggaran dan pengeluaran
        $totalAnggaran = Anggaran::sum('nominal');
        $totalPengeluaran = Pengeluaran::sum('nominal');
        $anggaranTerpakai = $totalAnggaran > 0 ? ($totalPengeluaran / $totalAnggaran) * 100 : 0;

        // Data untuk chart
        $chartData = $this->getChartData();

        // Menghitung pertumbuhan anggaran
        $tahunIni = date('Y');
        $tahunLalu = $tahunIni - 1;
        
        $anggaranTahunIni = Anggaran::whereYear('created_at', $tahunIni)->sum('nominal');
        $anggaranTahunLalu = Anggaran::whereYear('created_at', $tahunLalu)->sum('nominal');
        
        $pertumbuhanAnggaran = 0;
        if ($anggaranTahunLalu > 0) {
            $pertumbuhanAnggaran = (($anggaranTahunIni - $anggaranTahunLalu) / $anggaranTahunLalu) * 100;
        }

        // Data untuk statistik tambahan
        $pengeluaranPerTahun = [];
        foreach ($chartData['labels'] as $year) {
            $nominal = Pengeluaran::whereYear('created_at', $year)->sum('nominal');
            $pengeluaranPerTahun[$year] = $nominal;
        }

        // Statistik pengeluaran
        $averagePengeluaran = count($chartData['labels']) > 0 ? array_sum($pengeluaranPerTahun) / count($chartData['labels']) : 0;
        $maxPengeluaran = count($pengeluaranPerTahun) > 0 ? max($pengeluaranPerTahun) : 0;
        $minPengeluaran = count($pengeluaranPerTahun) > 0 ? min($pengeluaranPerTahun) : 0;
        $maxPengeluaranTahun = array_search($maxPengeluaran, $pengeluaranPerTahun) ?: '-';
        $minPengeluaranTahun = array_search($minPengeluaran, $pengeluaranPerTahun) ?: '-';

        return view('dashboard.index', compact(
            'totalAnggaran',
            'totalPengeluaran',
            'anggaranTerpakai',
            'chartData',
            'averagePengeluaran',
            'maxPengeluaran',
            'minPengeluaran',
            'maxPengeluaranTahun',
            'minPengeluaranTahun',
            'pertumbuhanAnggaran',
            'tahunIni'
        ));
    }

    private function getChartData()
    {
        $years = Anggaran::selectRaw('DISTINCT YEAR(created_at) as year')
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        $chartData = [
            'labels' => $years,
            'anggaran' => [],
            'pengeluaran' => []
        ];

        foreach ($years as $year) {
            $chartData['anggaran'][] = Anggaran::whereYear('created_at', $year)->sum('nominal');
            $chartData['pengeluaran'][] = Pengeluaran::whereYear('created_at', $year)->sum('nominal');
        }

        return $chartData;
    }
}
