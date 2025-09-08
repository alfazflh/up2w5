<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenIka extends Model
{
    use HasFactory;

    protected $table = 'dokumen_ika';

    protected $fillable = ['nama_dokumen', 'file_dokumen'];
}
