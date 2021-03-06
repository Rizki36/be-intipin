<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KelurahanResource extends JsonResource
{
    /**
     * Merubah data menjadi sebuah array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id_kelurahan' => $this->id,
            'id_kecamatan' => $this->kecamatan->id,
            'nama_kelurahan' => $this->nama,
            'nama_kecamatan' => $this->kecamatan->nama
        ];
    }
}
