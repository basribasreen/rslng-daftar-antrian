<?php

namespace Database\Factories;

use App\Models\Pasien;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pasien>
 */
class PasienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode' => 'RM-' . fake()->unique()->numerify('########'),
            // 'kode'      => fake()->unique()->regexify('RM-[A-Z]{3}[1-9]{2}'),
            // 'nik'      => fake()->randomDigit(),
            'nik'      => fake()->unique()->numerify('################'),
            'nama'      => fake()->name(),
            'is_active' => fake()->boolean(30),
            'nohp' => fake()->phoneNumber(),
            'jenis_kelamin' => fake()->randomElement([
                'L',
                'P',
            ]),
        ];
    }
}
