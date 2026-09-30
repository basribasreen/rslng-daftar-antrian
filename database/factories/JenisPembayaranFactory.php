<?php

namespace Database\Factories;

use App\Models\JenisPembayaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JenisPembayaran>
 */
class JenisPembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode'      => fake()->unique()->regexify('MP-[A-Z]{3}[1-9]{2}'),
            'nama'      => fake()->randomElement([
                'BPJS',
                'UMUM',
            ]),
            'is_active' => fake()->boolean(30),
        ];
    }
}
