<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengukuranNotLangsung extends Model
{
    use HasFactory;

    protected $fillable = [
        'form1s_id',
        'arus_primer_r',
        'arus_primer_s',
        'arus_primer_t',
        'arus_sekunder_r',
        'arus_sekunder_s',
        'arus_sekunder_t',
        'ratio_r',
        'ratio_s',
        'ratio_t',
        'akurasi_r',
        'akurasi_s',
        'akurasi_t',
        'voltase_primer_r',
        'voltase_primer_s',
        'voltase_primer_t',
        'cos_r',
        'cos_s',
        'cos_t',
        'akurasi_kwh_meter',
        'keterangan',
    ];
    

}
