<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAllSettingRequest extends FormRequest
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
            'description_1' => 'required|min:3|max:255',
            'description_2' => 'required|min:3|max:255',
            // 'image_1' => 'image|mimes:jpg,png,jpeg|max:2048|nullable',
            // 'image_2' => 'image|mimes:jpg,png,jpeg|max:2048|nullable',
        ];
    }
}
