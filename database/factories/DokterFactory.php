<?php

namespace Database\Factories;

use App\Models\Dokter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dokter>
 */
class DokterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode'      => fake()->unique()->regexify('DOK-[A-Z]{3}[1-9]{2}'),
            'nama'      => fake()->name(),
            'spesialis'      => fake()->randomElement([
                'Dokter Umum',
                'Dokter Anak',
                'Dokter Gigi',
            ]),
            'is_active' => fake()->boolean(30),
            'nohp' => fake()->phoneNumber(),
            'jenis_kelamin' => fake()->randomElement([
                'L',
                'P',
            ]),
        ];
    }
}
