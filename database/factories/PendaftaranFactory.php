<?php

namespace Database\Factories;

use App\Models\Dokter;
use App\Models\JenisPembayaran;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Poli;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pendaftaran>
 */
class PendaftaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode' => 'REG-' . fake()->unique()->numerify('########'),
            'id_pasien' => Pasien::factory(),
            'id_dokter' => Dokter::factory(),
            'id_poli' => Poli::factory(),
            'id_pembayaran' => JenisPembayaran::factory(),
            'tanggal' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'nomor_antrian' => 'A' . fake()->unique()->numberBetween(1, 100),
            'status' => fake()->randomElement([
                'menunggu',
                'dipanggil',
                'selesai',
            ]),
        ];
    }
}
