@extends('layouts.app')

@section('content')

<div class="container-fluid mt-4">
    <!-- Konten lainnya -->
</div>

    
    <div class="row">
        <!-- Total Anggaran -->
        <div class="col-md-4">
            <div class="card border-primary shadow">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">💰 Total Anggaran</h5>
                    <h2 class="text-primary">Rp {{ number_format($totalAnggaran, 0, ',', '.') }}</h2>
                    <p class="text-muted">Total anggaran yang tersedia saat ini.</p>
                    <a href="{{ route('anggaran.index') }}" class="btn btn-primary btn-sm">Lihat Anggaran</a>
                </div>
            </div>
        </div>

        <!-- Total Pengeluaran -->
        <div class="col-md-4">
            
            <div class="card border-success shadow">
                <div class="card-body text-center">
                    <h5 class="card-title text-success">📉 Total Pengeluaran</h5>
                    <h2 class="text-success">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h2>
                    <p class="text-muted">Total pengeluaran yang sudah tercatat.</p>
                    <a href="{{ route('pengeluaran.index') }}" class="btn btn-success btn-sm">Lihat Pengeluaran</a>
                </div>
            </div>
        </div>

        <!-- Persentase Anggaran Terpakai -->
        <div class="col-md-4">
            <div class="card border-warning shadow">
                <div class="card-body text-center">
                    <h5 class="card-title text-warning">📊 Anggaran Terpakai</h5>
                    <h2 class="text-warning">{{ number_format($anggaranTerpakai, 2) }}%</h2>
                    <p class="text-muted">Persentase anggaran yang digunakan.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <h3 class="text-center mb-4">Ringkasan Grafik Anggaran & Pengeluaran</h3>
        <canvas id="myChart" style="max-height: 1000%; width: 150%;"></canvas>
    </div>
    
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    
const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Anggaran', 'Pengeluaran'],
            datasets: [{
                label: 'Jumlah',
                data: [50000000, 30000000],
                backgroundColor: ['#007bff', '#28a745']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    const dashboardChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Sisa Anggaran', 'Pengeluaran'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ $totalAnggaran - $totalPengeluaran }}, {{ $totalPengeluaran }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)', // Sisa Anggaran
                    'rgba(255, 99, 132, 0.6)'  // Pengeluaran
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
            }
        }
    });

    <div class="container-fluid mt-5">
    <h3 class="text-center mb-4">Ringkasan Grafik Anggaran & Pengeluaran</h3>

    <!-- Kolom untuk menampilkan Total Anggaran dan Total Pengeluaran -->
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h4 class="card-title">Total Anggaran</h4>
                    <p class="card-text">Rp 50.000.000</p>
                    <a href="#" class="btn btn-light">Lihat Anggaran</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h4 class="card-title">Total Pengeluaran</h4>
                    <p class="card-text">Rp 30.000.000</p>
                    <a href="#" class="btn btn-light">Lihat Pengeluaran</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h4 class="card-title">Anggaran Terpakai</h4>
                    <p class="card-text">60.00%</p>
                    <a href="#" class="btn btn-light">Lihat Laporan</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik anggaran & pengeluaran -->
    <div class="row">
        <div class="col-12">
            <canvas id="grafikAnggaran"></canvas>
        </div>
    </div>
</div>


</script>
@endsection
