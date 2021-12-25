<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class insertAdmin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:admins,email',
            'photo' => 'required|mimes:png,jpg',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id|array|min:1',
        ];
    }
}
