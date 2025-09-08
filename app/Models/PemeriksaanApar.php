<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanApar extends Model
{
    use HasFactory;

    protected $table = 'apars'; // nama tabel di database

    protected $fillable = [
        'id_apar',
        'lokasi',
        'isi_apar',
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


    public function apar()
{
    return $this->belongsTo(Apar::class, 'id_apar', 'id_apar');
}
}
