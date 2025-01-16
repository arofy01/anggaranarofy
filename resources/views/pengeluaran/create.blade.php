@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Tambah Pengeluaran</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('pengeluaran.store') }}" method="POST" id="pengeluaranForm">
                @csrf
                
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <select name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror" required>
                        <option value="">Pilih Tahun</option>
                        @foreach($tahunList as $tahun)
                            <option value="{{ $tahun }}" {{ old('tahun') == $tahun ? 'selected' : '' }}
                                data-anggaran="{{ isset($anggaranList[$tahun]) ? $anggaranList[$tahun]['total'] : 0 }}"
                                data-used="{{ isset($anggaranList[$tahun]) ? $anggaranList[$tahun]['used'] : 0 }}">
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" id="anggaranInfo" style="display: none;">
                    <div class="alert alert-info">
                        <p class="mb-1"><strong>Total Anggaran:</strong> <span id="totalAnggaran">Rp 0</span></p>
                        <p class="mb-1"><strong>Total Terpakai:</strong> <span id="totalTerpakai">Rp 0</span></p>
                        <p class="mb-0"><strong>Sisa Anggaran:</strong> <span id="sisaAnggaran">Rp 0</span></p>
                    </div>
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
                    <small class="text-muted">Format angka akan otomatis ditambahkan (contoh: ketik 1000000 akan menjadi 1.000.000)</small>
                    @error('nominal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('pengeluaran.index') }}" class="btn btn-secondary">Batal</a>
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
        const tahunSelect = document.getElementById('tahun');
        const anggaranInfo = document.getElementById('anggaranInfo');
        const totalAnggaranSpan = document.getElementById('totalAnggaran');
        const totalTerpakaiSpan = document.getElementById('totalTerpakai');
        const sisaAnggaranSpan = document.getElementById('sisaAnggaran');
        let currentSisa = 0;

        // Update anggaran info when tahun changes
        tahunSelect.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            const totalAnggaran = parseInt(selected.dataset.anggaran) || 0;
            const totalTerpakai = parseInt(selected.dataset.used) || 0;
            currentSisa = totalAnggaran - totalTerpakai;

            totalAnggaranSpan.textContent = 'Rp ' + formatRupiah(totalAnggaran.toString());
            totalTerpakaiSpan.textContent = 'Rp ' + formatRupiah(totalTerpakai.toString());
            sisaAnggaranSpan.textContent = 'Rp ' + formatRupiah(currentSisa.toString());
            
            anggaranInfo.style.display = totalAnggaran > 0 ? 'block' : 'none';
        });

        // Format awal jika ada nilai
        if (nominalInput.value) {
            nominalInput.value = formatRupiah(nominalInput.value);
        }
        
        // Format saat input
        nominalInput.addEventListener('input', function(e) {
            // Simpan posisi kursor
            const start = this.selectionStart;
            const length = this.value.length;
            
            // Hapus karakter non-digit dan format ulang
            let value = this.value.replace(/[^\d]/g, '');
            this.value = formatRupiah(value);
            
            // Hitung perubahan panjang untuk menyesuaikan posisi kursor
            const newLength = this.value.length;
            const cursorPos = start + (newLength - length);
            
            // Kembalikan kursor ke posisi yang tepat
            this.setSelectionRange(cursorPos, cursorPos);
        });
        
        // Validasi sebelum submit
        document.getElementById('pengeluaranForm').addEventListener('submit', function(e) {
            const nominal = parseInt(nominalInput.value.replace(/\./g, ''));
            if (nominal > currentSisa) {
                e.preventDefault();
                alert('Nominal melebihi sisa anggaran yang tersedia (Rp ' + formatRupiah(currentSisa.toString()) + ')');
            } else {
                nominalInput.value = nominalInput.value.replace(/\./g, '');
            }
        });
        
        // Fungsi format Rupiah
        function formatRupiah(angka) {
            if (!angka) return '';
            
            // Pastikan input adalah string
            angka = angka.toString();
            
            // Format dengan pemisah ribuan
            return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Trigger change event jika ada nilai terpilih
        if (tahunSelect.value) {
            tahunSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endpush
@endsection
