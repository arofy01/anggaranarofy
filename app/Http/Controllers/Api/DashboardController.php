<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggaran;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getStats()
    {
        $totalAnggaran = Anggaran::sum('jumlah');
        $totalPengeluaran = Pengeluaran::sum('jumlah');
        
        // Hitung trend (perbandingan dengan periode sebelumnya)
        $lastMonth = Carbon::now()->subMonth();
        $lastMonthPengeluaran = Pengeluaran::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('jumlah');
        
        $currentMonthPengeluaran = Pengeluaran::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('jumlah');
        
        // Hitung persentase perubahan
        $pengeluaranTrend = $lastMonthPengeluaran > 0 
            ? (($currentMonthPengeluaran - $lastMonthPengeluaran) / $lastMonthPengeluaran * 100)
            : 0;
            
        // Anggaran trend (perubahan dari bulan lalu)
        $lastMonthAnggaran = Anggaran::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('jumlah');
            
        $currentMonthAnggaran = Anggaran::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('jumlah');
            
        $anggaranTrend = $lastMonthAnggaran > 0
            ? (($currentMonthAnggaran - $lastMonthAnggaran) / $lastMonthAnggaran * 100)
            : 0;

        return response()->json([
            'totalAnggaran' => $totalAnggaran,
            'totalPengeluaran' => $totalPengeluaran,
            'anggaranTerpakai' => $totalAnggaran > 0 ? ($totalPengeluaran / $totalAnggaran * 100) : 0,
            'anggaranTrend' => round($anggaranTrend, 1),
            'pengeluaranTrend' => round($pengeluaranTrend, 1)
        ]);
    }

    public function getChartData($period)
    {
        $now = Carbon::now();
        $labels = [];
        $anggaranData = [];
        $pengeluaranData = [];

        switch ($period) {
            case 'day':
                // Data per jam untuk 24 jam terakhir
                for ($i = 23; $i >= 0; $i--) {
                    $time = $now->copy()->subHours($i);
                    $labels[] = $time->format('H:i');
                    
                    $anggaranData[] = Anggaran::whereDate('created_at', $time->toDateString())
                        ->whereHour('created_at', $time->hour)
                        ->sum('jumlah');
                        
                    $pengeluaranData[] = Pengeluaran::whereDate('created_at', $time->toDateString())
                        ->whereHour('created_at', $time->hour)
                        ->sum('jumlah');
                }
                break;

            case 'week':
                // Data harian untuk 7 hari terakhir
                for ($i = 6; $i >= 0; $i--) {
                    $date = $now->copy()->subDays($i);
                    $labels[] = $date->format('D');
                    
                    $anggaranData[] = Anggaran::whereDate('created_at', $date->toDateString())
                        ->sum('jumlah');
                        
                    $pengeluaranData[] = Pengeluaran::whereDate('created_at', $date->toDateString())
                        ->sum('jumlah');
                }
                break;

            case 'month':
                // Data mingguan untuk 4 minggu terakhir
                for ($i = 3; $i >= 0; $i--) {
                    $startDate = $now->copy()->subWeeks($i)->startOfWeek();
                    $endDate = $startDate->copy()->endOfWeek();
                    $labels[] = 'Minggu ' . (4 - $i);
                    
                    $anggaranData[] = Anggaran::whereBetween('created_at', [$startDate, $endDate])
                        ->sum('jumlah');
                        
                    $pengeluaranData[] = Pengeluaran::whereBetween('created_at', [$startDate, $endDate])
                        ->sum('jumlah');
                }
                break;
        }

        return response()->json([
            'labels' => $labels,
            'anggaran' => $anggaranData,
            'pengeluaran' => $pengeluaranData
        ]);
    }
}
