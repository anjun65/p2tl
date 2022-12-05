<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrafoNotLangsung extends Model
{
    use HasFactory;

    protected $fillable = [
        'form1s_id',
        'trafoct_merk',
        'trafoct_cls',
        'trafoct_rasio',
        'trafoct_burden',
        'trafopt_merk',
        'trafopt_cls',
        'trafopt_rasio',
        'trafopt_burden',
    ];
    

}
