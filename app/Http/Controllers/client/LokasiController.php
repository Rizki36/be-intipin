<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    public function pondok()
    {
        $lokasi = Lokasi::with('kecamatan', 'kelurahan')->pondok()->get();
        $kecamatan = Kecamatan::all();

        return view('pondok', [
            'lokasi' => $lokasi,
            'kecamatan' => $kecamatan,
        ]);
    }

    public function produk()
    {
        $lokasi = Lokasi::with('kecamatan', 'kelurahan')->produk()->get();
        $kecamatan = Kecamatan::all();

        return view('produk', [
            'lokasi' => $lokasi,
            'kecamatan' => $kecamatan,
        ]);
    }
}
