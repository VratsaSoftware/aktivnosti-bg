<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class NewsFormRequest extends FormRequest
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
		if(Auth::user()->hasRole('organization_manager') || Auth::user()->hasRole('organization_member')){
			$zero = 'gt:0';
		}else{
			$zero = 'min:0';
		}
        return [
            'description' => 'required|min:250',
			'name' => 'required|min:5|max:255',
			'organization_id' => $zero,
            'description' => 'required|max:10000',
			'photo'=> 'required|nullable|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
		
    }

    public function messages()
    {
        return [
			'name.required' => 'Моля въведете заглавие',
			'description.required' => 'Напишете новина',
			'description.min' => 'Новината не трябва да е под 250 знака',
			'photo.required' => 'Не е избрана снимка',
			'photo.mimes' => 'Формата на изображението не се поддържа',
            'photo.max' => 'Размерът на файла трябва да бъде по-малък от 2MB',
			'organization_id.gt' => 'Изберете организация'
        ];
    }
}