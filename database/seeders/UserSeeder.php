<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        User::create([
            'name' => 'Admin BAPPEDA',
            'email' => 'admin@bappeda.go.id',
            'password' => bcrypt('admin123'),
        ]);

        // Staff users
        User::create([
            'name' => 'Staff Anggaran',
            'email' => 'anggaran@bappeda.go.id',
            'password' => bcrypt('staff123'),
        ]);

        User::create([
            'name' => 'Staff Keuangan',
            'email' => 'keuangan@bappeda.go.id',
            'password' => bcrypt('staff123'),
        ]);

        // Development/testing user
        User::create([
            'name' => 'arofy',
            'email' => 'arofy@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
