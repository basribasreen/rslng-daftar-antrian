<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->foreignId('id_pasien')
                ->constrained('pasiens')
                ->restrictOnDelete();
            $table->foreignId('id_poli')
                ->constrained('polis')
                ->restrictOnDelete();
            $table->foreignId('id_dokter')
                ->constrained('dokters')
                ->restrictOnDelete();
            $table->foreignId('id_pembayaran')
                ->constrained('jenis_pembayarans')
                ->restrictOnDelete();
            $table->date('tanggal');
            $table->string('nomor_antrian', 10);
            $table->string('status', 20)->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
