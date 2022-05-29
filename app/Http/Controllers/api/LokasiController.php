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
            $lokasi = Lokasi::pondok()->get();
        } else if ($type === 2) {
            $lokasi = Lokasi::produk()->get();
        } else {
            $lokasi = Lokasi::all();
        }

        return response()->json($lokasi);
    }
}
