<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPembayaran extends Model
{
    /** @use HasFactory<\Database\Factories\JenisPembayaranFactory> */
    use HasFactory;
    
    protected $fillable = ['kode', 'nama', 'is_active'];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }
    
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, function ($q) use ($term) {
            $q->where('kode', 'like', "%{$term}%")
            ->orWhere('nama', 'like', "%{$term}%");
        });
    }
    
    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        return $query->when($status, function ($q) use ($status) {
            match ($status) {
                'active'    => $q->where('is_active', true),
                'inactive' => $q->where('is_active', false),
                default   => $q,
            };
        });
    }
}
