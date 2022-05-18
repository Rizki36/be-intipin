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
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        return new KelurahanResource($kelurahan);
    }
}
