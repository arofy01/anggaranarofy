@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Anggaran</h1>

        <form action="{{ route('anggaran.update', $anggaran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="number" class="form-control" id="tahun" name="tahun" value="{{ old('tahun', $anggaran->tahun) }}" required>
            </div>

            <div class="mb-3">
                <label for="nama_anggaran" class="form-label">Nama Anggaran</label>
                <input type="text" class="form-control" id="nama_anggaran" name="nama_anggaran" value="{{ old('nama_anggaran', $anggaran->nama_anggaran) }}" required>
            </div>

            <div class="mb-3">
                <label for="sumber" class="form-label">Sumber</label>
                <input type="text" class="form-control" id="sumber" name="sumber" value="{{ old('sumber', $anggaran->sumber) }}" required>
            </div>

            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal</label>
                <input type="number" class="form-control" id="nominal" name="nominal" value="{{ old('nominal', $anggaran->nominal) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
