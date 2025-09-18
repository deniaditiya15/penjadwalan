<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;                // tambahkan ini
use Illuminate\Support\Facades\Hash; // tambahkan ini

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepsek@example.com',
            'password' => Hash::make('password'),
            'role' => 'kepsek'
        ]);

        User::create([
            'name' => 'Guru Matematika',
            'email' => 'guru@example.com',
            'password' => Hash::make('password'),
            'role' => 'guru'
        ]);
    }
}
