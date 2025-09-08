<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_apat',
        'lokasi',
        'kondisi_fisik',
        'drum',
        'aduk_pasir',
        'sekop',
        'fire_blanket',
        'ember',
        'tanggal_pemeriksaan',
        'petugas_pengawas',
        'catatan',
        'kesimpulan',
    ];
}
