<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poligon extends Model
{
    use HasFactory;

    protected $table = 'poligon';
    protected $fillable = [
        'lat',
        'lng',
        'id_kecamatan',
    ];
}
