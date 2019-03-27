<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Photo;
use App\Models\City;
use App\Models\Purpose;
use File;

class OrganizationController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function index()
    {
		$organizations = Organization::all()->where('approved_at', '!=', null);
        return view('organizations.index', compact('organizations'));
    }
	
	public function adminOrg()
    {
		$organizations = Organization::all();
        return view('organizations.adminOrg', compact('organizations'));
    }
	
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function create()
    {
        return view('organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//set default city
        $default_city = City::firstOrCreate(['name' => 'Враца', 'country_id' => '1']); 
		
		$organization = new Organization;
        $organization->name = $request->get('name');
        $organization->description = $request->get('description');
        $organization->email = $request->get('email');
		$organization->website = $request->get('website');
        $organization->address = $request->get('address');
        $organization->phone = $request->get('phone');
		$organization->city_id = $default_city->city_id;
        $organization->save();
		
		 //store organization image in public\user_files\images\organization
        if(isset($request['photo'])){
            $original_name = $request['photo']->getClientOriginalName();
			$file_name = uniqid().$original_name;
            $store_file = $request['photo']->move('user_files/images/organization', $file_name);
            //$path_to_image = '../public/user_files/images/organization/'.$file_name;
            //add organization image to DB
            //prepare purposes table if not ready
            $photo_purpose = Purpose::where('description','logo')->first();
            if(!$photo_purpose){
                $photo_purpose=Purpose::firstOrCreate(['description' => 'logo']);
            }

            //store image in photos table
			
            $organization->photos()->create([
                'image_path' => $file_name,
                'alt' => 'organization photo',
                'description' => 'organization photo' ,
                'purpose_id' => $photo_purpose->purpose_id,
            ]);
        }
		
		//validate organization requests
		$this->validate($request,[
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:500'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
			'website' => ['string', 'max:255'],
            'phone' => ['regex:/^[0-9\-\(\)\/\+\s]*$/'], 
			//'photo'=> ['mimes:jpg,png,jpeg,gif,svg','max:2048'],
        ],
		[
            'name.required' => 'Моля въведете име',
            'email.required' => 'Моля въведете E-mail адрес', 
            'email.email' => 'Моля въведете валиден E-mail адрес',
            'address.required' => 'Моля въведете адрес',
            'phone.regex' => 'Моля въведете валиден телефонен номер',
           // 'photo.mimes' => 'Формата на изображението не се поддържа',
            //'photo.max' => 'Размерът на файла трябва да бъде по-малък от 2MB'
        ]);
		
        return redirect('citadel/organizations')->with('message', 'Създадена е нова организация');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organization = Organization::findOrFail($id);
        return view('organizations.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organization = Organization::findOrFail($id);
        return view('organizations.edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $default_city = City::firstOrCreate(['name' => 'Враца', 'country_id' => '1']); 
		
		$organization = Organization::find($id);;
        $organization->name = $request->get('name');
        $organization->description = $request->get('description');
        $organization->email = $request->get('email');
		$organization->website = $request->get('website');
        $organization->address = $request->get('address');
        $organization->phone = $request->get('phone');
		$organization->city_id = $default_city->city_id;
        $organization->save();
		
		if(isset($request['photo'])){
			
			//delete old photo
			foreach($organization->photos as $photo){
				$old_photo = $photo->image_path;
			}
			//File::delete(public_path().'user_files/images/organization/'.$old_photo);
			File::delete('user_files/images/organization/'.$old_photo);
			
            $original_name = $request['photo']->getClientOriginalName();
			$file_name = uniqid().$original_name;
            $store_file = $request['photo']->move('user_files/images/organization', $file_name);
           // $path_to_image = public_path().'/user_files/images/organization'.$file_name;
		
			$organization->photos()->update([
				'image_path' => $file_name
			]);
		}
		
		//validate organization requests
		$this->validate($request,[
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:500'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
			'website' => ['string', 'max:255'],
            'phone' => ['regex:/^[0-9\-\(\)\/\+\s]*$/'], 
			//'photo'=> ['mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
        ],
		[
            'name.required' => 'Моля въведете име',
            'email.required' => 'Моля въведете E-mail адрес', 
            'email.email' => 'Моля въведете валиден E-mail адрес',
            'address.required' => 'Моля въведете адрес',
            'phone.regex' => 'Моля въведете валиден телефонен номер',
			//'photo.mimes' => 'Формата на изображението не се поддържа',
			//'photo.max' => 'Размерът на файла трябва да бъде по-малък от 2MB'
        ]);
		
        return redirect()->back()->with('message', 'Организацията '.$organization->name.' е одобрена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organization = Organization::find($id);
        $organization->delete();
        return redirect()->back()->with('message', 'Организацията '.$organization->name.' е изтрита!');
    }
	public function approve($id)
    {
        $organization = Organization::find($id);
        $organization->approved_at = (date('Y-m-d H:i:s'));
        $organization->save();
        return redirect()->back()->with('message', 'Организацията '.$organization->name.' е одобрена!');
    }
}
