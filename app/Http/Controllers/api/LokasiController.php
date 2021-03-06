<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index(Request $request)
    {
        $type = (int)$request->get('type');

        if ($type === 1) {
            $lokasi = Lokasi::with(['kelurahan:id,nama', 'kecamatan:id,nama'])->pondok()->get();
        } else if ($type === 2) {
            $lokasi = Lokasi::with(['kelurahan:id,nama', 'kecamatan:id,nama'])->produk()->get();
        } else {
            $lokasi = Lokasi::with(['kelurahan:id,nama', 'kecamatan:id,nama'])->get();
        }

        return response()->json($lokasi);
    }
}
