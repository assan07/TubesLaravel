<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama' => 'Admin Sistem',
                'nim' => 'ADM0001',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bendahara Asrama',
                'nim' => 'BEN0001',
                'email' => 'bendahara@gmail.com',
                'password' => Hash::make('bendahara123'),
                'role' => 'bendahara',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Mahasiswa Contoh',
                'nim' => 'MHS12345',
                'email' => 'mahasiswa@gmail.com',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'mahasiswa',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
