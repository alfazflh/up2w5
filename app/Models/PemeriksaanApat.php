<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanApat extends Model
{
    use HasFactory;

    protected $table = 'apats'; // nama tabel di database

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
        'petugas',
        'pengawas',
        'catatan',
        'kesimpulan',
    ];


    public function apar()
{
    return $this->belongsTo(Apar::class, 'id_apat', 'id_apat');
}
}
