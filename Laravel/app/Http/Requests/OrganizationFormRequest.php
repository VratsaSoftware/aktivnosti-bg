<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
class OrganizationFormRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|min:3', 
            'description' => 'required|min:30',
			'name' => 'required|max:255',
            'description' => 'required|max:1000',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
			'website' => 'max:255',
            'phone' => 'regex:/^[0-9\-\(\)\/\+\s]*$/', 
			'photo'=> 'nullable|mimes:jpg,png,jpeg,gif,svg|max:2048',
			'gallery'=> 'nullable|mimes:jpg,png,jpeg,gif,svg|max:2048',
			'gallery'=> 'array|between:1,5',
        ];
    }


    public function messages()
    {
        return [
			'name.required' => 'Моля въведете име',
            'email.required' => 'Моля въведете E-mail адрес', 
            'email.email' => 'Моля въведете валиден E-mail адрес',
            'address.required' => 'Моля въведете адрес',
            'phone.regex' => 'Моля въведете валиден телефонен номер',
			'photo.mimes' => 'Формата на изображението не се поддържа',
            'photo.max' => 'Размерът на файла трябва да бъде по-малък от 2MB',
			'gallery.between' => 'Броя на снимките е надвишен',
			'gallery.max' => 'Размерът на файла трябва да бъде по-малък от 2MB',
			'gallery.mimes' => 'Формата на изображението не се поддържа',
        ];
    }
}