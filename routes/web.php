<?php

use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $gallery = Gallery::all();
    $description_1 = Setting::where('name', 'description_1')->first();
    $description_2 = Setting::where('name', 'description_2')->first();
    $image_1 = Setting::where('name', 'image_1')->first();
    $image_2 = Setting::where('name', 'image_2')->first();

    return view('welcome', [
        'gallery' => $gallery,
        'description_1' => $description_1->value,
        'description_2' => $description_2->value,
        'image_1' => $image_1->value,
        'image_2' => $image_2->value,
    ]);
});

Route::get('/pondok', function () {
    return view('pondok');
});

Route::get('/produk', function () {
    return view('produk');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::resource('admin/admin', AdminController::class);
Route::get('admin/admin/datatable', [AdminController::class, 'datatable'])->name('admin.datatable');

Route::put('admin/setting/all', [SettingController::class, 'update_all'])->name('setting.update_all');
Route::resource('/admin/setting', SettingController::class)->parameter('setting', 'id');
Route::resource('/admin/gallery', GalleryController::class)->parameter('gallery', 'id');

Route::get('/admin/lokasi', function () {
    return view('admin.lokasi');
});


Route::controller(KecamatanController::class)->group(function () {
    // menampilkan data kecamatan berdasarkan id
    Route::get('/kecamatan/{id}', 'show');

    // menampilkan semua data kecamatan
    Route::get('/kecamatan', 'index');
});

Route::controller(KelurahanController::class)->group(function () {
    // menampilkan semua data kelurahan
    Route::get('/kelurahan', 'index');

    // menampilkan data kelurahan berdasarkan id
    Route::get('/kelurahan/{id}', 'show');
});