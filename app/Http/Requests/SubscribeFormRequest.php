<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SubscribeFormRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Моля въведете E-mail адрес', 
            'email.email' => 'Моля въведете валиден E-mail адрес',
        ];
    }

    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
        ];
    }
}
