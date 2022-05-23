<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/pondok', function () {
    return view('pondok');
});

Route::get('/produk', function () {
    return view('produk');
});

// login
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'loginAction'])->name('auth.loginAction');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // admin
    Route::resource('admin/admin', AdminController::class);
    Route::get('admin/admin/datatable', [AdminController::class, 'datatable'])->name('admin.datatable');

    // setting
    Route::put('admin/setting/all', [SettingController::class, 'update_all'])->name('setting.update_all');
    Route::resource('/admin/setting', SettingController::class)->parameter('setting', 'id');
    Route::resource('/admin/gallery', GalleryController::class)->parameter('gallery', 'id');

    // lokasi
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
});
