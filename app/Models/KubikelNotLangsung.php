<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KubikelNotLangsung extends Model
{
    use HasFactory;

    protected $fillable = [
        'form1s_id',
        'merk',
        'type',
        'no_seri',
        'tahun',

    ];
}
