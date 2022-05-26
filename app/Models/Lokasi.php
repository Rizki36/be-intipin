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

    public function getTipeLokasiAttribute()
    {
        if ($this->tipe == 1) {
            return 'Pondok Pesantren';
        } else if ($this->tipe == 2) {
            return 'Produk Unggulan';
        } else {
            return '';
        }
    }
}
