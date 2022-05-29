<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jmlPondok = Lokasi::pondok()->count();
        $jmlProduk = Lokasi::produk()->count();

        return view('admin.dashboard', [
            'jmlPondok' => $jmlPondok,
            'jmlProduk' => $jmlProduk,
        ]);
    }
}
