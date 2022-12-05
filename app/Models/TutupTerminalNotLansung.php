<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutupTerminalNotLansung extends Model
{
    use HasFactory;

    protected $fillable = [
        'form1s_id',
        'peralatan', 
        'segel',
        'nomor_tahun_kode_segel',
        'keterangan',
        'post_pemeriksaan_peralatan',
        'post_segel',
        'post_nomor_tahun_kode_segel',
        'post_keterangan',
    ];
}
