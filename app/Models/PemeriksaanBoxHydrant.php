<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanBoxHydrant extends Model
{
    use HasFactory;

    protected $table = 'box_hydrants'; // nama tabel di database

    protected $fillable = [
        'id_boxhydrant',
        'lokasi',
        'nama',
        'catatan',
        'tanggal_pemeriksaan',
        'petugas',
        'pengawas',
        'pilar_hydrant',
        'box_hydrant',
        'noozle',
        'selang',
        'uji_fungsi',
        'kesimpulan',
    ];
}
