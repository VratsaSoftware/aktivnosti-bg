<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileFormRequest extends FormRequest
{
 /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check(); 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Моля въведете име',
            'name.string' => 'Моля въведете валидно име',
            'family.required' => 'Моля въведете фамилно име',
            'family.string' => 'Моля въведете валидно фамилно име',
            'email.required' => 'Моля въведете E-mail адрес', 
            'email.email' => 'Моля въведете валиден E-mail адрес',
            'email.unique' => 'Потребител с такъв E-mail адрес вече съществува',     
            'address.required' => 'Моля въведете адрес',
            'phone.regex' => 'Моля въведете валиден телефонен номер',
            'photo.mimes' => 'Формата на изображението не се поддържа',
            'photo.max' => 'Размерът на файла трябва да бъде по-малък от 2MB',
            'description.max' => 'Не повече от 255 символа',
        ];
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'family' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->user_id.',user_id'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['nullable','regex:/^[0-9\-\(\)\/\+\s]*$/'],
            'description' => ['nullable','string', 'max:255'],
            'photo'=> ['nullable','mimes:jpg,png,jpeg,gif,svg','max:2048'],           
        ];
    }
}
