<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firealarm extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_firealarm',
        'nama',
        'lokasi',
        'kondisi_fisik',
        'fungsi',
        'kesimpulan',
        'tanggal_pemeriksaan',
        'petugas',
        'pengawas',
        'catatan',
    ];
}

