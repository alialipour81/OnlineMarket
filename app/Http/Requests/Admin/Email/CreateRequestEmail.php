<?php

namespace App\Http\Requests\Admin\Email;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequestEmail extends FormRequest
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
            'email'=>['required','email','unique:emails,email']
        ];
    }
}
