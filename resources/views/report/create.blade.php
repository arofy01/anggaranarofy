@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Tambah Laporan Pengeluaran</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('report.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <select name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror" required>
                        <option value="">Pilih Tahun</option>
                        @foreach($tahunList as $tahun)
                            <option value="{{ $tahun }}" {{ old('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_pengeluaran" class="form-label">Nama Pengeluaran</label>
                    <input type="text" class="form-control @error('nama_pengeluaran') is-invalid @enderror" 
                           id="nama_pengeluaran" name="nama_pengeluaran" value="{{ old('nama_pengeluaran') }}" required>
                    @error('nama_pengeluaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                              id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nominal" class="form-label">Nominal</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control @error('nominal') is-invalid @enderror" 
                               id="nominal" name="nominal" value="{{ old('nominal') }}" 
                               placeholder="0" required>
                    </div>
                    <small class="text-muted">Format: 1.000.000 (gunakan titik sebagai pemisah ribuan)</small>
                    @error('nominal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('report.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nominalInput = document.getElementById('nominal');
        
        // Format awal jika ada nilai
        if (nominalInput.value) {
            nominalInput.value = formatRupiah(nominalInput.value);
        }
        
        // Format saat input
        nominalInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, ''); // Hapus semua karakter non-digit
            this.value = formatRupiah(value);
        });
        
        // Hapus format sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const value = nominalInput.value.replace(/\D/g, '');
            nominalInput.value = value;
        });
        
        // Fungsi format Rupiah
        function formatRupiah(angka) {
            if (!angka) return '';
            const reverse = angka.toString().split('').reverse().join('');
            let ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return ribuan;
        }
    });
</script>
@endpush
@endsection
