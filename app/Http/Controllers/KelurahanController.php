<?php

namespace App\Http\Controllers;

use App\Http\Resources\KelurahanResource;
use App\Models\Kelurahan;

class KelurahanController extends Controller
{
    /**
     * Menampilkan semua data kelurahan
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelurahans = Kelurahan::all();
        return KelurahanResource::collection($kelurahans);
    }

    /**
     * Menampikan kelurahan berdasarkan id
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show(Kelurahan $kelurahan)
    {
        $kelurahan = Kelurahan::findOrFail($kelurahan->id);
        return new KelurahanResource($kelurahan);
    }
}
