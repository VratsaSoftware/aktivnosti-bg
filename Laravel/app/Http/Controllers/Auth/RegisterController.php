<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use App\Models\City;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Organization;
use App\Models\Photo;
use App\Models\Purpose;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $organizations=Organization::select('organization_id','name')->pluck('name','organization_id')->toArray();

        return view('auth.register',compact('organizations'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $organizations=implode(",",array_keys(Organization::select('organization_id','name')->pluck('name','organization_id')->toArray())).',0';

        $messages=[
            'name.required' => 'Моля въведете име',
            'name.string' => 'Моля въведете валидно име',
            'family.required' => 'Моля въведете фамилно име',
            'family.string' => 'Моля въведете валидно фамилно име',
            'email.required' => 'Моля въведете E-mail адрес', 
            'email.email' => 'Моля въведете валиден E-mail адрес',
            'email.unique' => 'Потребител с такъв E-mail адрес вече съществува',     
            'password:required' => 'Въведете парола',  
            'password:min' => 'Паролата трябва да има минимум шест символа',
            'password:confirmed' => 'Повторението на паролата не съвпада',
            'address.required' => 'Моля въведете адрес',
            'phone.regex' => 'Моля въведете валиден телефонен номер',
            'photo.mimes' => 'Формата на изображението не се поддържа',
            'photo.max' => 'Размерът на файла трябва да бъде по-малък от 2MB',
            'organization.in' => 'Невалидна организация',

        ];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'family' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['nullable','regex:/^[0-9\-\(\)\/\+\s]*$/'],
            'photo'=> ['nullable','mimes:jpg,png,jpeg,gif,svg','max:2048'],
            'organization' => ['in:'.$organizations],
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //set default country and city
        $default_country = Country::firstOrCreate(['name' => 'България', 'country_id' => '1']);
        $default_city = City::firstOrCreate(['name' => 'Враца', 'country_id' => '1']);

        $user = new User;
        $user->name = $data['name'];
        $user->family = $data['family'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->address = $data['address'];
        $user->city_id = $default_city->city_id;
        $user->phone = $data['phone'];
        $user->save();

        //store profile image in public\user_files\images\profile
        if(isset($data['photo'])){
            
            $file_name = (time().'p'.mt_rand(1,99));
            $store_file=$data['photo']->move('user_files/images/profile', $file_name);

            //prepare purposes table if not ready
            $photo_purpose = Purpose::where('description','profile')->first();
            if(!$photo_purpose){
                $photo_purpose=Purpose::firstOrCreate(['description' => 'profile']);
            }

            //store image in photos table
            $user->photo()->create([
                'image_path' => $file_name,
                'alt' => 'user photo',
                'description' => 'profile photo' ,
                'purpose_id' => $photo_purpose->purpose_id,
            ]);
        }

        //Set User organization
        if($data['organization']!=0){
        $user->organizations()->attach($data['organization']);
        return $user;
        }
        //Handover to Organizations controller
        else{
            session(['newOrganizationFlag' => 1]);
            return $user;
        }
    }
}
