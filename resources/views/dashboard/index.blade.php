@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <div class="container-fluid p-4">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="dashboard-title">Aplikasi Anggaran BAPPEDA</h1>
                <p class="dashboard-subtitle">Sistem Informasi Pengelolaan Anggaran yang Efektif dan Transparan</p>
            </div>
        </div>
        <div class="row">
            <!-- Statistics Cards -->
            <div class="col-md-4 mb-4">
                <div class="stats-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper bg-primary bg-opacity-10">
                                <i class="fas fa-money-bill-wave fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h6 class="stat-title">Total Anggaran</h6>
                                <h3 class="stat-value" id="totalAnggaran">Rp 0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="stats-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper bg-danger bg-opacity-10">
                                <i class="fas fa-file-invoice fa-2x text-danger"></i>
                            </div>
                            <div>
                                <h6 class="stat-title">Total Pengeluaran</h6>
                                <h3 class="stat-value" id="totalPengeluaran">Rp 0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="stats-card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper bg-success bg-opacity-10">
                                <i class="fas fa-chart-pie fa-2x text-success"></i>
                            </div>
                            <div>
                                <h6 class="stat-title">Persentase Penggunaan</h6>
                                <h3 class="stat-value">{{ number_format($anggaranTerpakai, 1) }}%</h3>
                            </div>
                        </div>
                        <div class="progress mt-3">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ $anggaranTerpakai }}%"
                                 aria-valuenow="{{ $anggaranTerpakai }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="col-12">
                <div class="row">
                    <!-- Bar Chart -->
                    <div class="col-md-8 mb-4">
                        <div class="chart-card">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">Anggaran & Pengeluaran per Tahun</h5>
                                <div class="chart-info text-end">
                                    <p class="mb-0 text-muted">
                                        <small>
                                            <i class="fas fa-square text-primary"></i> Anggaran
                                            <i class="fas fa-square text-danger ms-2"></i> Pengeluaran
                                        </small>
                                    </p>
                                    @if(!empty($chartData['labels']))
                                    <p class="mb-0 text-muted">
                                        <small>Tahun {{ min($chartData['labels']) }} - {{ max($chartData['labels']) }}</small>
                                    </p>
                                    @endif
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="anggaranChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Doughnut Chart -->
                    <div class="col-md-4 mb-4">
                        <div class="chart-card">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">Distribusi Anggaran</h5>
                                <div class="chart-info text-end">
                                    <p class="mb-0 text-muted">
                                        <small>Total: {{ number_format($totalAnggaran, 0, ',', '.') }}</small>
                                    </p>
                                    <p class="mb-0 text-muted">
                                        <small>Sisa: {{ number_format($totalAnggaran - $totalPengeluaran, 0, ',', '.') }}</small>
                                    </p>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas id="distributionChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.dashboard-container {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    min-height: calc(100vh - var(--navbar-height));
    padding: 20px 0;
}

.stats-card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.2s, box-shadow 0.2s;
    backdrop-filter: blur(10px);
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.chart-card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    padding: 1.5rem;
    backdrop-filter: blur(10px);
}

.badge {
    font-weight: 500;
    font-size: 0.875rem;
}

.badge i {
    font-size: 0.875rem;
}

.page-header h4 {
    font-weight: 600;
    color: #ffffff;
}

.page-header .text-muted {
    font-size: 0.875rem;
    color: rgba(255,255,255,0.8) !important;
}

.gap-3 {
    gap: 1rem !important;
}

.icon-wrapper {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    background: rgba(255,255,255,0.1);
}

.stat-title {
    color: #6c757d;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.stat-value {
    margin-bottom: 0;
    font-weight: 600;
    color: #2c3e50;
}

.chart-container {
    position: relative;
    height: 300px;
}

.progress {
    height: 8px;
    border-radius: 4px;
    background-color: rgba(0,0,0,0.05);
}

.chart-info i.fas {
    font-size: 10px;
}

.card-title {
    color: #2c3e50;
}

.text-muted {
    color: #6c757d !important;
}

.dashboard-title {
    color: #ffffff;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
}

.dashboard-subtitle {
    color: rgba(255,255,255,0.9);
    font-size: 1.1rem;
    font-weight: 400;
    margin-bottom: 0;
}

.btn-outline-primary {
    border-color: #1e3c72;
    color: #1e3c72;
}

.btn-outline-primary:hover {
    background-color: #1e3c72;
    border-color: #1e3c72;
    color: #fff;
}
</style>
@endpush

@push('scripts')
<script>
    // Format currency
    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(amount);
    }

    // Animate value
    function animateValue(obj, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const current = Math.floor(progress * (end - start) + start);
            obj.textContent = formatCurrency(current);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    // Initialize animations
    document.addEventListener('DOMContentLoaded', function() {
        const totalAnggaranElement = document.getElementById('totalAnggaran');
        const totalPengeluaranElement = document.getElementById('totalPengeluaran');
        
        animateValue(totalAnggaranElement, 0, {{ $totalAnggaran }}, 1000);
        animateValue(totalPengeluaranElement, 0, {{ $totalPengeluaran }}, 1000);
    });

    // Bar Chart
    const anggaranChart = new Chart(document.getElementById('anggaranChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                label: 'Anggaran',
                data: {!! json_encode($chartData['anggaran']) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Pengeluaran',
                data: {!! json_encode($chartData['pengeluaran']) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return formatCurrency(value);
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + formatCurrency(context.raw);
                        }
                    }
                }
            }
        }
    });

    // Doughnut Chart
    const distributionChart = new Chart(document.getElementById('distributionChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Terpakai', 'Sisa'],
            datasets: [{
                data: [{{ $totalPengeluaran }}, {{ $totalAnggaran - $totalPengeluaran }}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + formatCurrency(context.raw);
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection
