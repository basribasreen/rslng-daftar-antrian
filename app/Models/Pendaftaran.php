<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
                'dipanggil' => $q->where('status', 'dipanggil'),
                'selesai' => $q->where('status', 'selesai'),
                default   => $q,
            };
        });
    }
    
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function poli():BelongsTo
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    public function dokter():BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }
    
    public function jenisPembayaran():BelongsTo
    {
        return $this->belongsTo(JenisPembayaran::class,'id_pembayaran');
    }

    public static function nomorBerikutnya(CarbonInterface $tanggal): array
    {
        $urutan = (int) static::whereDate('tanggal', $tanggal)->max('nomor_antrian') + 1;
    
        return [
            'nomor_antrian' => $urutan,
            'kode'          => 'REG-'.$tanggal->format('Ymd').'-'.str_pad($urutan, 4, '0', STR_PAD_LEFT),
        ];
    }
}
