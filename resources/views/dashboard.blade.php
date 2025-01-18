@extends('layouts.masterlw')

@section('konten')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4" style="background-color: #fff; border-radius: 10px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div style="background-color: #e3f2fd; padding: 10px; border-radius: 10px; margin-right: 15px;">
                            <i class="fas fa-money-bill text-primary" style="font-size: 24px;"></i>
                        </div>
                        <div>
                            <div class="text-muted">Total Anggaran</div>
                            <h3 class="mb-0">Rp 3.101.000.000</h3>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('anggaran.index') }}" class="btn btn-primary btn-selengkapnya w-100">
                            <span>Selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4" style="background-color: #fff; border-radius: 10px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div style="background-color: #ffebee; padding: 10px; border-radius: 10px; margin-right: 15px;">
                            <i class="fas fa-file-invoice-dollar text-danger" style="font-size: 24px;"></i>
                        </div>
                        <div>
                            <div class="text-muted">Total Pengeluaran</div>
                            <h3 class="mb-0">Rp 110.000.500</h3>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('pengeluaran.index') }}" class="btn btn-danger btn-selengkapnya w-100">
                            <span>Selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4" style="background-color: #fff; border-radius: 10px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div style="background-color: #e8f5e9; padding: 10px; border-radius: 10px; margin-right: 15px;">
                            <i class="fas fa-chart-pie text-success" style="font-size: 24px;"></i>
                        </div>
                        <div>
                            <div class="text-muted">Persentase Penggunaan</div>
                            <h3 class="mb-0">3.5%</h3>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('report.index') }}" class="btn btn-success btn-selengkapnya w-100">
                            <span>Selengkapnya</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
