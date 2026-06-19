<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ USER DUMMY GURU
        User::create([
            'name'     => 'Guru Demo',
            'email'    => 'guru@mengajiyuk.test',
            'password' => Hash::make('password'),
            'role'     => 'guru',
        ]);

        // ✅ USER DUMMY SANTRI
        User::create([
            'name'     => 'Santri Demo',
            'email'    => 'santri@mengajiyuk.test',
            'password' => Hash::make('password'),
            'role'     => 'santri',
        ]);
    }
}