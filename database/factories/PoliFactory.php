<?php

namespace Database\Factories;

use App\Models\Poli;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Poli>
 */
class PoliFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {    
        return [
            'kode' => 'POLI-' . fake()->unique()->numerify('########'),
            // 'kode'      => fake()->unique()->regexify('POL-[A-Z]{3}[1-9]{2}'),
            'nama'      => fake()->randomElement([
                'Poli Umum',
                'Poli Anak',
                'Poli Gigi',
            ]),
            'is_active' => fake()->boolean(30),
            'deskripsi' => fake()->optional()->paragraph(),
        ];
    }
}
