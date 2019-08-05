<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use App\Models\Role;

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
            'organization.in' => 'Невалидна организация',
            'role.in' => 'Невалидна роля!',
            'role.not_in' => 'Невалидна роля!!'
        ];
    }

    public function rules()
    {
        //available organizations
        $organizations = implode(",",Organization::select('organization_id','name')->pluck('organization_id')->toArray()).',0';
        
        //available roles
        $roles = implode(",",Role::select('role_id','role')->pluck('role_id')->toArray()).',0';

        //admin protection
        $adminRole = '';
        if(!Auth::user()->hasRole('admin'))
        {
            $adminRole=Role::select('role_id')->where('role','admin')->first()->role_id;
        }
       
        return [
            'organization' => ['in:'.$organizations],
            'role' => ['in:'.$roles],
            'role' => ['not_in:'.$adminRole],
        ];
    }
}
