@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Pengeluaran</h1>

    <!-- Form Filter Tanggal -->
    <form action="{{ route('report.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-5">
                <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="{{ $tanggalAwal ?? '' }}">
            </div>
            <div class="col-md-5">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ $tanggalAkhir ?? '' }}">
            </div>
            <div class="col-md-2 align-self-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <!-- Tabel Laporan -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pengeluaran</th>
                <th>Admin</th>
                <th>Jumlah</th>
                <th>Anggaran</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reports as $report)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report->nama_pengeluaran }}</td>
                    <td>{{ $report->admin->nama ?? 'Tidak Diketahui' }}</td>
                    <td>Rp {{ number_format($report->jumlah, 2, ',', '.') }}</td>
                    <td>{{ $report->anggaran->nama_anggaran ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $report->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data laporan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
