<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class insertSection extends FormRequest
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
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'photo' => 'required_without:id',
        ];
    }

    public function messages(){
        return [
            'required' => __('messages.required'),
            'required_without' => __('messages.required'),
            'string' => __('messages.string'),
        ];
    }
}
