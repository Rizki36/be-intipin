<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Http\Resources\KecamatanResource;

class KecamatanController extends Controller
{
    /**
     * menampilkan semua data kecamatan
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecamatans = Kecamatan::all();
        return KecamatanResource::collection($kecamatans);
    }

    /**
     * Menampikan kecamatan berdasarkan id
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan)
    {
        $kecamatan = Kecamatan::findOrFail($kecamatan->id);
        return new KecamatanResource($kecamatan);
    }
}
