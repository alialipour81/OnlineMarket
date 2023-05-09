<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestProduct extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'brand_id'=>['required','integer'],
            'category_id'=>['required','integer'],
            'title_fa'=>['required'],
            'title_en'=>['required'],
            'colors'=>['required'],
            'gr'=>['required'],
            'forosh'=>['required'],
            'price'=>['required','integer'],
            'takhfif'=>['integer'],
            'description'=>['required'],
            'attributes'=>['required'],
        ];
    }
}
