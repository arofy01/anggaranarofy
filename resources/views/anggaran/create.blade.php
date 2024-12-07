@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Anggaran</h1>

        <form action="{{ route('anggaran.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="number" class="form-control" id="tahun" name="tahun" required>
            </div>

            <div class="mb-3">
                <label for="nama_anggaran" class="form-label">Nama Anggaran</label>
                <input type="text" class="form-control" id="nama_anggaran" name="nama_anggaran" required>
            </div>

            <div class="mb-3">
                <label for="sumber" class="form-label">Sumber</label>
                <input type="text" class="form-control" id="sumber" name="sumber" required>
            </div>

            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal</label>
                <input type="number" class="form-control" id="nominal" name="nominal" required>
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
@endsection
