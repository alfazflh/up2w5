<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanFireAlarm extends Model
{
    use HasFactory;

    protected $table = 'firealarms'; // nama tabel di database

    protected $fillable = [
        'id_firealarm',
        'lokasi',
        'nama',
        'catatan',
        'tanggal_pemeriksaan',
        'petugas',
        'pengawas',
        'kondisi_fisik',
        'fungsi',
        'kesimpulan',
    ];
}
