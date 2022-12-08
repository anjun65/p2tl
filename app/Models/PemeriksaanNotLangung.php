<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanNotLangung extends Model
{
    use HasFactory;

    protected $fillable = [
        'form1s_id',
        'tegangan_tersambung',
        'jenis_pengukuran',
        'tempat_kedudukan_APP',
        'pembatas_jenis',
        'pembatas_merk',
        'pembatas_arus',
    ];

}
