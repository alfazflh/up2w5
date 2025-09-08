<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanRumahPompa extends Model
{
    use HasFactory;

    protected $table = 'rumah_pompa'; // sesuaikan dengan nama tabel di database

    protected $fillable = [
        'id_rumah',
        'pipa',
        'valve',
        'oli',
        'bbm',
        'air',
        'tegangan',
        'filter_oli',
        'filter_bbm',
        'filter_udara',
        'kekencangan',
        'terminal',
        'panel',
        'pemanasan',
        'indikator',
        'matikan',
        'kondisi',
        'ruangan',
        'elektrik',
        'jocky',
        'selector',
        'fungsi',
        'kesimpulan',
        'tanggal_pemeriksaan',
        'petugas',
        'pengawas',
        'catatan',
    ];

    public function rumahPompa()
{
    return $this->belongsTo(RumahPompa::class, 'id_rumah', 'id_rumah');
}

}
