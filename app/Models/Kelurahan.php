<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'Kelurahan';
    protected $fillable = ['nama'];
    protected $with = ['kecamatan:id,nama'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
