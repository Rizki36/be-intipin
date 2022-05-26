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

    /**
     * cast tipe into tipe name
     * @return string
     */
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


    /**
     * get pondok pesantren
     * @return string
     */
    public function scopePondok($query)
    {
        return $query->where('tipe', '=', 1);
    }

    /**
     * get produk produk unggulan
     * @return string
     */
    public function scopeProduk($query)
    {
        return $query->where('tipe', '=', 2);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }
}
