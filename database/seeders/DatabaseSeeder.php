<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menjalankan AdminSeeder untuk membuat data admin default
        $this->call([
            AdminSeeder::class,
        ]);

        // Menjalankan UserSeeder untuk membuat data user default
        $this->call([
            UserSeeder::class,
        ]);

        // Membuat data anggaran contoh
        \App\Models\Anggaran::create([
            'nama_program' => 'Program Pembangunan Infrastruktur',
            'nominal' => 1000000000,
            'tahun' => 2025,
            'keterangan' => 'Anggaran pembangunan infrastruktur daerah',
            'admin_id' => 1
        ]);

        \App\Models\Anggaran::create([
            'nama_program' => 'Program Pendidikan',
            'nominal' => 750000000,
            'tahun' => 2025,
            'keterangan' => 'Anggaran pengembangan pendidikan',
            'admin_id' => 1
        ]);

        // Membuat data pengeluaran contoh
        \App\Models\Pengeluaran::create([
            'keterangan' => 'Pembayaran Konstruksi Jalan',
            'nominal' => 250000000,
            'tanggal' => now(),
            'admin_id' => 1
        ]);

        \App\Models\Pengeluaran::create([
            'keterangan' => 'Pengadaan Alat Pendidikan',
            'nominal' => 150000000,
            'tanggal' => now(),
            'admin_id' => 1
        ]);

        // Membuat data laporan contoh
        \App\Models\Report::create([
            'judul' => 'Laporan Keuangan Q1 2025',
            'deskripsi' => 'Laporan keuangan triwulan pertama tahun 2025',
            'periode' => '2025-Q1',
            'status' => 'selesai',
            'admin_id' => 1
        ]);

        \App\Models\Report::create([
            'judul' => 'Laporan Anggaran Tahunan 2024',
            'deskripsi' => 'Laporan penggunaan anggaran tahun 2024',
            'periode' => '2024',
            'status' => 'selesai',
            'admin_id' => 1
        ]);
    }
}
