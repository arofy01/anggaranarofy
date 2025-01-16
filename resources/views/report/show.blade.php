@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Laporan Pengeluaran</h5>
                <div>
                    <a href="{{ route('report.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                    <a href="{{ route('report.exportPDF') }}?id={{ $pengeluaran->id }}" class="btn btn-success ms-2" target="_blank">
                        <i class="fas fa-file-pdf me-1"></i>Export PDF
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Tahun</th>
                            <td>: {{ $pengeluaran->tahun }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pengeluaran</th>
                            <td>: {{ $pengeluaran->nama_pengeluaran }}</td>
                        </tr>
                        <tr>
                            <th>Nominal</th>
                            <td>: Rp {{ number_format($pengeluaran->nominal, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>: {{ $pengeluaran->keterangan ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Dibuat</th>
                            <td>: {{ $pengeluaran->created_at ? $pengeluaran->created_at->format('d F Y H:i:s') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Diupdate</th>
                            <td>: {{ $pengeluaran->updated_at ? $pengeluaran->updated_at->format('d F Y H:i:s') : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
