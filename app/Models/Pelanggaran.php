<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'works_id',
        'path_ba_pengambilan_bb',
        'path_ba_serah_terima_bb',
        'path_image',
        'path_video',
        'status',
    ];

    public function work()
    {
        return $this->belongsTo(WorkOrder::class, 'works_id', 'id');
    }

    const Status = [
        'BA Selesai' => 'BA Selesai',
        'P1' => 'P1',
        'P2' => 'P2',
        'P3' => 'P3',
        'P4' => 'P4',
        'K1' => 'K1',
        'K2' => 'K2',
        'K3' => 'K3',
    ];

}
