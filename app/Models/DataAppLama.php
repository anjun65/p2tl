<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAppLama extends Model
{
    use HasFactory;

    protected $fillable = [
        'form1s_id',
        'merk',
        'no_reg',
        'no_seri',
        'tahun_pembuatan',
        'class',
        'konstanta',
        'rating_arus',
        'tegangan_nominal',
        'stand_kwh_meter',
        'jenis_pembatas',
        'alat_pembatas_merk',
        'rating_arus', 
    ];
    
}
