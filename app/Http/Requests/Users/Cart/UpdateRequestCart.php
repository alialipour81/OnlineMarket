<?php

namespace App\Http\Requests\Users\Cart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestCart extends FormRequest
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
            'quantity'=>['required','integer']
        ];
    }
}
