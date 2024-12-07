@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Pengeluaran</h1>

    <form action="{{ route('pengeluaran.update', $pengeluaran->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Metode PUT diperlukan -->
        <div class="form-group">
            <label for="nama_pengeluaran">Nama Pengeluaran</label>
            <input type="text" name="nama_pengeluaran" value="{{ $pengeluaran->nama_pengeluaran }}" class="form-control" required>
        </div>
        <br>
        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            
            <input type="number" name="jumlah" value="{{ $pengeluaran->jumlah }}" class="form-control" required>
        </div>
        <br>
        <div class="form-group">
            <label for="anggaran_id">Anggaran</label>
            <select name="anggaran_id" class="form-control" required>
                @foreach($anggarans as $anggaran)
                    <option value="{{ $anggaran->id }}" {{ $pengeluaran->anggaran_id == $anggaran->id ? 'selected' : '' }}>
                        {{ $anggaran->nama_anggaran }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <!-- Tambahkan margin pada tombol -->
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        
    </form>
    
    
</div>
@endsection
