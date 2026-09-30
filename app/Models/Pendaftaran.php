<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    /** @use HasFactory<\Database\Factories\PendaftaranFactory> */
    use HasFactory;
    
    protected $fillable = ['kode', 'id_pasien', 'id_poli', 'id_dokter', 'id_pembayaran', 'tanggal', 'nomor_antrian', 'status'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, function ($q) use ($term) {
            $q->where('tanggal', 'like', "%{$term}%")
            ->orWhere('nomor_antrian', 'like', "%{$term}%");
        });
    }
    
    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        return $query->when($status, function ($q) use ($status) {
            match ($status) {
                'menunggu'    => $q->where('status', 'menunggu'),
                'dipanggil' => $q->where('is_active', 'dipanggil'),
                'selesai' => $q->where('is_active', 'selesai'),
                default   => $q,
            };
        });
    }
    
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
    
    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class);
    }
}
