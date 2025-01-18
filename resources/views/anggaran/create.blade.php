@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Anggaran</h1>

        <form action="{{ route('anggaran.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun</label>
                <select class="form-select" id="tahun" name="tahun" required>
                    <option value="">Pilih Tahun</option>
                    @php
                        $currentYear = date('Y');
                        $startYear = $currentYear - 5;
                        $endYear = $currentYear + 5;
                    @endphp
                    @for($year = $startYear; $year <= $endYear; $year++)
                        <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
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
