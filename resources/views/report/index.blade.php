@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Laporan</h5>
                <div>
                    <a href="{{ route('report.exportPDF') }}?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}" 
                       class="btn btn-success ms-2" target="_blank">
                        <i class="fas fa-file-pdf me-1"></i>Export PDF
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <form action="{{ route('report.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search me-1"></i>Filter
                        </button>
                        <a href="{{ route('report.index') }}" class="btn btn-secondary">
                            <i class="fas fa-redo me-1"></i>Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Nama Pengeluaran</th>
                            <th>Keterangan</th>
                            <th>Nominal</th>
                            <th>Tanggal Input</th>
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $report->tahun }}</td>
                                <td>{{ $report->nama_pengeluaran }}</td>
                                <td>{{ $report->keterangan ?? '-' }}</td>
                                <td class="">Rp {{ number_format($report->nominal, 0, ',', '.') }}</td>
                                <td>{{ $report->created_at ? $report->created_at->format('d/m/Y H:i') : '-' }}</td>
                                <td class="text-center">
                                    <!-- <a href="{{ route('report.show', $report->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a> -->
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Summary -->
            @if($reports->isNotEmpty())
            <div class="mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">Ringkasan</h5>
                        <div class="row align-items-center">
                            <div class="col-8 border-end">
                                <p class="mb-2">Total Pengeluaran:</p>
                                <h2 class="text-success mb-0">Rp {{ number_format($reports->sum('nominal'), 0, ',', '.') }}</h2>
                            </div>
                            <div class="col-4 text-center">
                                <p class="mb-2">Jumlah Transaksi:</p>
                                <h4 class="mb-0">{{ $reports->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
