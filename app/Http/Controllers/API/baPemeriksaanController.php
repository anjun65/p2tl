<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BeritaAcara;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class baPemeriksaanController extends Controller
{
    public function store (Request $request)
    {
        $ba = BeritaAcara::create([
            'works_id' => $request->works_id,
            'path_ba_pemeriksaan' => $request->uploadFile,
        ]);

        return ResponseFormatter::success($ba,'BA Created');
    }
}
