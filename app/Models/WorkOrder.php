<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'id_pelanggan',
        'nama_pelanggan',
        'latitude',
        'longitude',
        'alamat',
        'tarif',
        'daya',
        'rbm',
        'lgkh',
        'fkm',
        'keterangan_p2tl',
    ];

    public function jam_nyala()
    {
        return $this->hasMany(WorkOrder::class, 'works_id', 'id');
    }

}
