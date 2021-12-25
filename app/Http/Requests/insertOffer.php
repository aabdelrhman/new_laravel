<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class insertOffer extends FormRequest
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
            'section_id' => 'exists:sections,id|nullable',
            'brand_id' => 'exists:brands,id|nullable',
            'product_id' => 'required_without:id|array|min:1|exists:products,id|unique:offers,product_id',
            'product' => 'required_with:id|exists:products,id|nullable|unique:offers,product_id,'.$this->id,
            'offer_ratio' => 'integer|required',
            'offer_begin' => 'date|required',
            'offer_end' => 'date|required',
        ];
    }
}
