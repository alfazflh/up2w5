<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanP3k extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan_p3k';

    protected $fillable = [
        'id_p3k',
        'tanggal_pemeriksaan',
        'petugas',
        'nama',
        'item',
        'jumlah',
        'keperluan',
        'kasa',
        'kadaluarsa_kasa',
        'catatan_kasa',
        'perban5cm',
        'kadaluarsa_perban5cm',
        'catatan_perban5cm',
        'perban10cm',
        'kadaluarsa_perban10cm',
        'catatan_perban10cm',
        'plester125cm', 
        'kadaluarsa_plester125cm',
        'catatan_plester125cm',
        'plester',
        'kadaluarsa_plester',
        'catatan_plester',
        'kapas',
        'kadaluarsa_kapas',
        'catatan_kapas',
        'mittela',
        'kadaluarsa_mittela',
        'catatan_mittela',
        'gunting',
        'kadaluarsa_gunting',
        'catatan_gunting',
        'peniti',
        'kadaluarsa_peniti',
        'catatan_peniti',
        'sarung_tangan',
        'kadaluarsa_sarung_tangan',
        'catatan_sarung_tangan',
        'pasangan',
        'masker',
        'kadaluarsa_masker',
        'catatan_masker',
        'pinset',
        'kadaluarsa_pinset',
        'catatan_pinset',
        'senter',
        'kadaluarsa_senter',
        'catatan_senter',
        'gelas',
        'kadaluarsa_gelas',
        'catatan_gelas',
        'plastik',
        'kadaluarsa_plastik',
        'catatan_plastik',
        'aquades',
        'kadaluarsa_aquades',
        'catatan_aquades',
        'povidon',
        'kadaluarsa_povidon',
        'catatan_povidon',
        'alkohol',
        'kadaluarsa_alkohol',
        'catatan_alkohol',
        'panduanp3k',
        'kadaluarsa_panduanp3k',
        'catatan_panduanp3k',
        'daftarisi',
        'kadaluarsa_daftarisi',
        'catatan_daftarisi',
    ];

    protected $dates = [
        'tanggal_pemeriksaan',
        'kadaluarsa_kasa',
        'kadaluarsa_perban5cm',
        'kadaluarsa_perban10cm',
        'kadaluarsa_plester125cm',
        'kadaluarsa_plester',
        'kadaluarsa_kapas',
        'kadaluarsa_mittela',
        'kadaluarsa_gunting',
        'kadaluarsa_peniti',
        'kadaluarsa_sarung_tangan',
        'kadaluarsa_masker',
        'kadaluarsa_pinset',
        'kadaluarsa_senter',
        'kadaluarsa_gelas',
        'kadaluarsa_plastik',
        'kadaluarsa_aquades',
        'kadaluarsa_povidon',
        'kadaluarsa_alkohol',
        'kadaluarsa_panduanp3k',
        'kadaluarsa_daftarisi',
    ];

    public function p3k()
    {
        return $this->belongsTo(P3k::class, 'id_p3k', 'id_p3k');
    }
}
