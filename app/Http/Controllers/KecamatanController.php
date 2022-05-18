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
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kecamatan = Kecamatan::with('kelurahan')->findOrFail($id);

        return [
            'id_kecamatan' => $kecamatan->id,
            'nama_kecamatan' => $kecamatan->nama,
            'kelurahan' => $kecamatan->kelurahan,
        ];
    }
}
