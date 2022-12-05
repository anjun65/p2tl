<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WiringAppNotLangsung extends Model
{
    use HasFactory;

    protected $fillable = [
        'form1s_id',
        'terminal1',
        'terminal2',
        'terminal3',
        'terminal4',
        'terminal5',
        'terminal6',
        'terminal7',
        'terminal8',
        'terminal9',
        'terminal11',
        'nilai_grounding',
        'keterangan_wiringapp',
    ];
}
