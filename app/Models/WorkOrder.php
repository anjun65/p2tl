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
        'path_image',
        'path_video',
        'status',
    ];

    public function jam_nyala()
    {
        return $this->hasMany(WorkOrder::class, 'works_id', 'id');
    }

    const Keterangan = [
        'BA' => 'Pemeriksaan Dengan BA',
        'RK' => 'Rumah Kosong/Bangunan tidak dihuni',
        'TO' => 'Tidak ada Orang',
        'Normal' => 'Normal | Diperiksa Tanpa BA',
    ];

    const Status = [
        'Open' => 'Open',
        'Close' => 'Close',
    ];

    public function regu()
    {
        return $this->belongsTo(Regu::class, 'regus_id', 'id');
    }

    public function ba_pemeriksaan()
    {
        return $this->hasOne(BeritaAcara::class, 'works_id', 'id');
    }
}
