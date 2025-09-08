<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apar extends Model
{
    protected $table = 'apars';
    protected $fillable = [
        'id_apar',
        'lokasi',
        'isi_apar',
        'kapasitas',
        'masa_berlaku',
        'catatan',
        'kesimpulan',
    ];
}
