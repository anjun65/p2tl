<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form1 extends Model
{
    use HasFactory;

    protected $fillable = [
        'works_id',
        'users_id',
        'no_ba',
        'surat_tugas_p2tl',
        'tanggal_surat_tugas_p2tl',
        'surat_tugas_tni',
        'tanggal_surat_tugas_tni',
        'nama_tni',
        'nip_tni',
        'jabatan_tni',
        'alamat_pelanggan',
        'tarif',
        'nama_saksi',
        'alamat_saksi',
        'nomor_identitas',
        'no_telpon_saksi',
    ];

    public function dataAppLama()
    {
        return $this->hasOne(DataAppLama::class);
    }

    public function dataAppBaru()
    {
        return $this->hasOne(DataAppBaru::class);
    }

    public function KWHMeter()
    {
        return $this->hasOne(KWHMeter::class);
    }

    public function terminalKwh()
    {
        return $this->hasOne(terminalKwh::class);
    }

    public function PelindungKwhMeter()
    {
        return $this->hasOne(PelindungKwhMeter::class);
    }

    public function PelindungBusbar()
    {
        return $this->hasOne(PelindungBusbar::class);
    }

    public function PapanOk()
    {
        return $this->hasOne(PapanOk::class);
    }

    public function PenutupMCB()
    {
        return $this->hasOne(PenutupMCB::class);
    }


}
