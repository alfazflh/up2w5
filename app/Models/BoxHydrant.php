<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoxHydrant extends Model
{
    protected $fillable = [
        'id_boxhydrant', 'lokasi', 'nama',
        'pilar_hydrant', 'box_hydrant', 'noozle', 'selang',
        'uji_fungsi', 'tanggal_pemeriksaan',
        'kesimpulan',
        'petugas', 'pengawas', 'catatan'
    ];
}

