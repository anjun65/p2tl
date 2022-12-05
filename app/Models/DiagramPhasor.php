<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagramPhasor extends Model
{
    use HasFactory;

    protected $fillable = [
        'form1s_id',
        'hasil_pemeriksaan',
        'kesimpulan',
        'tindakan',
        'barang_bukti',
        'hari',
        'tanggal',
    ];
}
