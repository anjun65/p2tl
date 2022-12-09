<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkOrder;
use App\Helpers\ResponseFormatter;

class WorkOrderController extends Controller
{
    public function all(Request $request)
    {
        $work_order = WorkOrder::all();

        if($work_order)
            return ResponseFormatter::success(
                $work_order,
                'Data work order berhasil diambil'
            );
        else
            return ResponseFormatter::error(
                null,
                'Data work order tidak ada',
                404
            );
    }

    public function store(Request $request)
    {
        $request->validate([
            'users_id' => ['required', 'string', 'max:255'],
            'id_pelanggan' => ['required', 'string', 'max:255'],
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'number', 'max:255'],
            'longitude' => ['required', 'number', 'max:255'],
            'alamat' => ['required', 'number', 'max:255'],
            'tarif' => ['required', 'number', 'max:255'],
            'daya' => ['required', 'number', 'max:255'],
            'rbm' => ['required', 'number', 'max:255'],
            'lgkh' => ['required', 'number', 'max:255'],
            'fkm' => ['required', 'number', 'max:255'],
            'keterangan_p2tl' => ['required', 'string', 'max:255'],
        ]);

        $workorder = WorkOrder::create([
            'users_id' => $request->users_id,
            'id_pelanggan' => $request->id_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'alamat' => $request->alamat,
            'tarif' => $request->tarif,
            'daya' => $request->daya,
            'rbm' => $request->rbm,
            'lgkh' => $request->lgkh,
            'fkm' => $request->fkm,
            'keterangan_p2tl' => $request->keterangan_p2tl,
        ]);

        return ResponseFormatter::success($workorder, 'Berhasil ditambahkan');
    }
}
