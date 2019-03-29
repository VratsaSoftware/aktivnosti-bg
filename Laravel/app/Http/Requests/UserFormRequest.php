<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;

class UserFormRequest extends FormRequest
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
            'organization.in' => 'Невалидна организация',

        ];
    }

    public function rules()
    {
        //available organizations
        $organizations = implode(",",Organization::select('organization_id','name')->pluck('organization_id')->toArray()).',0';
       
        return [
            'name' => ['required', 'string', 'max:255'],
            'family' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->user.',user_id'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['regex:/^[0-9\-\(\)\/\+\s]*$/'],
            'description' => ['nullable','string', 'max:255'],
            'photo'=> ['mimes:jpg,png,jpeg,gif,svg','max:2048'],
            'organization' => ['in:'.$organizations],
            
        ];
    }
}
