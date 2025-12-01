<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat satu user admin yang datanya pasti
        User::create([
            'name' => 'Admin Wisuda',
            'nim' => 'I0720001',
            'email' => 'admin@wisuda.test',
            'faculty' => 'FT',
            'major' => 'Informatika',
            'cohort' => '2020', // <-- INI DIA KUNCINYA
            'password' => Hash::make('password'),
        ]);

        // Panggil factory untuk membuat 500 user dummy tambahan
        User::factory(500)->create();
    }
}

