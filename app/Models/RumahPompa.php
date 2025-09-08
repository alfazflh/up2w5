<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahPompa extends Model
{
    use HasFactory;

    protected $table = 'rumah_pompa';

    protected $fillable = [
        'id_rumah',
        'catatan',
    ];
}
