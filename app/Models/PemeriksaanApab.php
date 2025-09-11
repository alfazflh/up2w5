<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanApab extends Model
{
    use HasFactory;

    protected $table = 'apabs'; // nama tabel di database

    protected $fillable = [
        'id_apab',
        'lokasi',
        'isi_apab',
        'kapasitas',
        'masa_berlaku',
        'catatan',
        'tanggal_pemeriksaan',
        'petugas',
        'pengawas',
        'kondisi_fisik',
        'pressure_gauge',
        'segel',
        'selang',
        'klem_selang',
        'handle',
        'kesimpulan',
    ];


    public function apab()
{
    return $this->belongsTo(Apab::class, 'id_apab', 'id_apab');
}
}
