<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsetTetap extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'aset_tetaps';

    protected $fillable = [
        'kode_aset',
        'nama_aset',
        'tipe',
        'alamat',
        'luas_tanah',
        'luas_bangunan',
        'tanggal_perolehan',
        'nilai_perolehan',
        'status_kepemilikan',
        'kondisi_bangunan',
        'pic',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_perolehan' => 'date',
        'nilai_perolehan' => 'decimal:2',
    ];
}
