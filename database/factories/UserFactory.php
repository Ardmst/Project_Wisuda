<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Siapkan data random yang lebih terstruktur
        $majorData = [
            'FT' => ['Informatika', 'Arsitektur', 'Teknik Sipil', 'Teknik Mesin'],
            'FKIP' => ['Pendidikan TIK', 'Pendidikan Sejarah', 'Pendidikan Fisika'],
            'FMIPA' => ['Matematika', 'Fisika', 'Biologi'],
            'FEB' => ['Akuntansi', 'Manajemen', 'Ekonomi Pembangunan'],
        ];
        $facultyCodes = ['FT' => 'I', 'FKIP' => 'K', 'FMIPA' => 'M', 'FEB' => 'F'];

        $namaFakultas = $this->faker->randomElement(array_keys($majorData));
        $namaProdi = $this->faker->randomElement($majorData[$namaFakultas]);
        $kodeFakultas = $facultyCodes[$namaFakultas];
        
        $tahunMasuk = $this->faker->numberBetween(2018, 2024);
        $tahunMasukKode = substr((string)$tahunMasuk, -2);
        $urutan = $this->faker->unique()->numerify('####');


        return [
            'name' => fake()->name(),
            'nim' => $kodeFakultas . '07' . $tahunMasukKode . $urutan,
            'email' => fake()->unique()->safeEmail(),
            'faculty' => $namaFakultas,
            'major' => $namaProdi,
            'cohort' => $tahunMasuk, // Ini yang terakhir kita perbaiki
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

