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
    ];

    public function work()
    {
        return $this->belongsTo(WorkOrder::class, 'works_id', 'id');
    }

}
