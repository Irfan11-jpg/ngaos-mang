<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kita panggil UserSeeder agar Guru & Santri masuk ke database
        $this->call([
            UserSeeder::class,
        ]);
    }
}