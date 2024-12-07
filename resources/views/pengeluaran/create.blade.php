@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Pengeluaran</h1>
    <form action="{{ route('pengeluaran.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_pengeluaran" class="form-label">Nama Pengeluaran</label>
            <input type="text" name="nama_pengeluaran" id="nama_pengeluaran" class="form-control" value="{{ old('nama_pengeluaran') }}" required>
            @error('nama_pengeluaran')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="admin_id" class="form-label">Admin</label>
            <select name="admin_id" id="admin_id" class="form-control" required>
                <option value="">Pilih Admin</option>
                @foreach ($admins as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->nama }}</option>
                @endforeach
            </select>
            @error('admin_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" step="0.01" value="{{ old('jumlah') }}" required>
            @error('jumlah')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="anggarans_id" class="form-label">Anggaran</label>
            <select name="anggarans_id" id="anggarans_id" class="form-control" required>
                <option value="">Pilih Anggaran</option>
                @foreach ($anggarans as $anggaran)
                    <option value="{{ $anggaran->id }}">{{ $anggaran->nama_anggaran }}</option>
                @endforeach
            </select>
            @error('anggarans_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pengeluaran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
