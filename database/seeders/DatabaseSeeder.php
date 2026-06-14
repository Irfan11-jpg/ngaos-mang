<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Guru
        \App\Models\User::create([
            'name'     => 'Guru Ngaji',
            'email'    => 'guru@ngaos.test',
            'password' => bcrypt('password'),
            'role'     => 'guru',
        ]);

        // Buat 3 Santri
        $santriList = ['Ahmad Fauzi', 'Siti Aisyah', 'Muhammad Rizki'];
        foreach ($santriList as $i => $nama) {
            \App\Models\User::create([
                'name'     => $nama,
                'email'    => 'santri' . ($i+1) . '@ngaos.test',
                'password' => bcrypt('password'),
                'role'     => 'santri',
            ]);
        }
    }  
}      