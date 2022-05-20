<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:4',
            'username' => 'required|unique:users|min:3|max:255',
        ];
    }
}
