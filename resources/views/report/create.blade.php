@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Laporan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('report.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_pengeluaran" class="form-label">Nama Pengeluaran</label>
            <input type="text" name="nama_pengeluaran" id="nama_pengeluaran" class="form-control" value="{{ old('nama_pengeluaran') }}" required>
        </div>

        <div class="mb-3">
            <label for="admin_id" class="form-label">Admin</label>
            <select name="admin_id" id="admin_id" class="form-control" required>
                <option value="">-- Pilih Admin --</option>
                @foreach ($admins as $admin)
                    <option value="{{ $admin->id }}" {{ old('admin_id') == $admin->id ? 'selected' : '' }}>
                        {{ $admin->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah') }}" required>
        </div>

        <div class="mb-3">
            <label for="anggarans_id" class="form-label">Anggaran</label>
            <select name="anggarans_id" id="anggarans_id" class="form-control" required>
                <option value="">-- Pilih Anggaran --</option>
                @foreach ($anggarans as $anggaran)
                    <option value="{{ $anggaran->id }}" {{ old('anggarans_id') == $anggaran->id ? 'selected' : '' }}>
                        {{ $anggaran->nama_anggaran }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
