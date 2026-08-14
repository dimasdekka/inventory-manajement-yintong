<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GolonganBarang extends Model
{
    use HasFactory;

    protected $table = 'golongan_barang';

    protected $fillable = [
        'kategori_id',
        'kode_golongan',
        'nama_golongan',
        'keterangan',
    ];

    /**
     * Relasi ke Kategori induk.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Relasi ke Barang di bawah golongan ini.
     */
    public function barang(): HasMany
    {
        return $this->hasMany(Barang::class, 'golongan_id');
    }
}
