<?php

namespace Database\Seeders;

use App\Models\JenisPembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisPembayaran::factory(2)->create();
    }
}
