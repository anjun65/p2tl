<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KwhMeterNotLangsung extends Model
{
    use HasFactory;

    protected $fillable = [
        'form1s_id',
        'merk',
        'no_register',
        'no_seri',
        'tahun_buat',
        'konstanta',
        'class_akurasi',
        'rating_arus',
        'tegangan',
        'lbp',
        'bp',
        'kwh_total',
    ];

}
