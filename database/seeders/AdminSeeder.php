<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Super Admin
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@bappeda.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'super_admin'
        ]);

        // Admin Anggaran
        Admin::create([
            'name' => 'Admin Anggaran',
            'email' => 'adminanggaran@bappeda.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin_anggaran'
        ]);

        // Admin Keuangan
        Admin::create([
            'name' => 'Admin Keuangan',
            'email' => 'adminkeuangan@bappeda.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin_keuangan'
        ]);

        // Admin Development
        Admin::create([
            'name' => 'Arofy',
            'email' => 'arofy@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'super_admin'
        ]);
    }
}
