<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLokasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO : ubah ke false jika auth sudah selesai
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'string',
            'alamat' => 'string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'tipe' => 'required|numeric|in:1,2',
            'link_google_maps' => 'required|string|url',
            'id_kecamatan' => 'required|string|max:255',
            'id_kelurahan' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
