<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'        => ['string', 'max:55','required'],
            'price'       => ['numeric','required'],
            'description' => ['string', 'max:255','required'],
            'category_id' => ['exists:App\Models\Category,id','required'],
            'image'       => ['array']
        ];

    }
}
