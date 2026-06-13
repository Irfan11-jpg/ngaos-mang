<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Data Guru
        User::create([
            'name' => 'Guru Ngaji',
            'email' => 'guru@ngaos.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
        ]);

        // Data Santri
        User::create([
            'name' => 'Santri Pintar',
            'email' => 'santri@ngaos.com',
            'password' => Hash::make('password'),
            'role' => 'santri',
        ]);
    }
}