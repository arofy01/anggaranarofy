@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Anggaran</h1>
    <a href="{{ route('anggaran.create') }}" class="btn btn-primary">Tambah Anggaran</a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Nama Anggaran</th>
                <th>Sumber</th>
                <th>Nominal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggarans as $anggaran)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $anggaran->tahun }}</td>
                    <td>{{ $anggaran->nama_anggaran }}</td>
                    <td>{{ $anggaran->sumber }}</td>
                    <td>{{ number_format($anggaran->nominal, 2) }}</td>
                    <td>
                        <a href="{{ route('anggaran.edit', $anggaran) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('anggaran.destroy', $anggaran) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
