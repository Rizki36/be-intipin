<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi';
    protected $fillable = [
        'nama',
        'deskripsi',
        'alamat',
        'lat',
        'lng',
        'tipe',
        'foto',
        'link_google_maps',
        'id_kecamatan',
        'id_kelurahan',
    ];
}
