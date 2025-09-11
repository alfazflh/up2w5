<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apab extends Model
{
    protected $table = 'apabs';
    protected $fillable = [
        'id_apab',
        'lokasi',
        'isi_apab',
        'kapasitas',
        'masa_berlaku',
        'catatan',
        'kesimpulan',
    ];
}
