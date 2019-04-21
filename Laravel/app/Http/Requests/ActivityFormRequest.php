<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ActivityFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return Auth::check();
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
            'name' => 'required|min:3|max:150', 
            'description' => 'required|min:30|max:2000',
            'address' => 'required|string|max:255',
            // 'photo'=> 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'photo'=> 'nullable|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'gallery'=> 'nullable|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'gallery'=> 'array|between:1,5',
            // 'price' => 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/',
            'min_age' => 'nullable|integer|between:1,100',
            // 'max_age'=>'min:'.(int)$this-> get ('min_age'),
            // 'max_age' => 'nullable|integer|between:1,100',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'duration' => 'nullable|string|max:255',
            'requirements' => 'nullable|string|max:255',
            'organization_id' => 'required',
            'available' => 'required',
            'fixed_start' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Моля въведете име',
            'name.min' => 'Наименованието на активността не трябва да е по-кратко от три знака',
            'name.max' => 'Наименованието на активността не трябва да е по-дълго от 150 знака',
            'description.required' => 'Моля направете описание',
            'description.min' => 'Описанието е твърде кратко',
            'description.max' => 'Описанието е твърде дълго',
            'description.max' => 'Описанието е твърде дълго',
            'address.required' => 'Моля въведете адрес',
            'start_date.required' => 'Моля въведете начална дата',
            'end_date.after' => 'Датата на приключване на активността трябва да е след датата на започване',
            'duration.max' => 'Описанието е твърде дълго',
            'requirements.max' => 'Описанието е твърде дълго',
            'organization_id.required' => 'Моля изберете организация',
            'available.required' => 'Моля направете избор за наличност',
            'fixed_start.required' => 'Моля направете избор за фиксиран старт',
            'price.regex' => 'Въведете положително число, което не е нула',
            'min_age.integer' => 'Въведете цяло положително число, което не е нула',
            'min_age.between' => 'Числото трябва да е от 1 до 100',
            'max_age.integer' => 'Въведете цяло положително число, което не е нула',
            'max_age.min' => 'Числото трябва да е по-голямо от въведената минимална възраст',
            'photo.mimes' => 'Формата на изображението не се поддържа',
            'photo.required' => 'Изборът на снимка е задължителен',
            'photo.max' => 'Размерът на файла трябва да бъде по-малък от 2MB',
            'gallery.between' => 'Броя на снимките е надвишен',
            'gallery.max' => 'Размерът на файла трябва да бъде по-малък от 2MB',
            'gallery.mimes' => 'Формата на изображението не се поддържа',
        ];
    }
}
