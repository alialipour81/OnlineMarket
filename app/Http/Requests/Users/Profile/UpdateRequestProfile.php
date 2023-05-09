<?php

namespace App\Http\Requests\Users\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestProfile extends FormRequest
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
            'name'=>['required'],
            'code_meli'=>['required','integer'],
            'card'=>['required','integer'],
            'number_phone'=>['required','integer'],
        ];
    }
}
