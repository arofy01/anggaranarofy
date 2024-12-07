@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Pengeluaran</h1>
    <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary mb-3">Tambah Pengeluaran</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pengeluaran</th>
                <th>Admin</th>
                <th>Jumlah</th>
                <th>Anggaran</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengeluarans as $pengeluaran)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengeluaran->nama_pengeluaran }}</td>
                    <td>{{ $pengeluaran->admin->nama ?? 'Tidak Diketahui' }}</td>
                    <td>Rp {{ number_format($pengeluaran->jumlah, 2, ',', '.') }}</td>
                    <td>{{ $pengeluaran->anggaran->nama_anggaran ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $pengeluaran->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('pengeluaran.edit', $pengeluaran->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pengeluaran.destroy', $pengeluaran->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data pengeluaran</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
