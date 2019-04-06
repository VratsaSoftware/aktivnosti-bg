<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Photo;
use App\Models\User;
use App\Models\City;
use App\Models\Purpose;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use File;

class OrganizationController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function __construct(){
    //Middleware organization
        $this->middleware('protect.organization')->except(['index','show','adminOrg','create','store']);;
    }
	 
    public function index()
    {
		  $organizations = Organization::all()->where('approved_at', '!=', null);
        return view('organizations.index', compact('organizations'));
    }
	
    public function adminOrg()
    {

		  if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
      {
        $organizations = Organization::all();
        return view('organizations.adminOrg', compact('organizations'));
		  }

		  if(Auth::user()->hasRole('organization_member') || Auth::user()->hasRole('organization_manager'))
		  {
        $organizations=Auth::user()->organizations()->orderBy('name')->get();
        if($organizations)
        {
				  return view('organizations.adminOrg', compact('organizations'));
        }
        return view('citadel.home');
		  }    
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
      if(isset($request['photo']))
      {
        $original_name = $request['photo']->getClientOriginalName();
        $file_name = uniqid().$original_name;
        $store_file = $request['photo']->move('user_files/images/organization', $file_name);
        //$path_to_image = '../public/user_files/images/organization/'.$file_name;
        //add organization image to DB
        //prepare purposes table if not ready
        $photo_purpose = Purpose::where('description','logo')->first();

        if(!$photo_purpose)
        {
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
		//store organization image in public\user_files\images\organization\gallery
      if(isset($request['gallery']))
      {
        $original_name = $request['gallery']->getClientOriginalName();
        $file_name = uniqid().$original_name;
        $store_file = $request['gallery']->move('user_files/images/organization/gallery', $file_name);
        //$path_to_image = '../public/user_files/images/organization/gallery'.$file_name;
        //add organization image to DB
        //prepare purposes table if not ready
        $photo_purpose = Purpose::where('description','gallery')->first();
        if(!$photo_purpose)
        {
          $photo_purpose=Purpose::firstOrCreate(['description' => 'gallery']);
        }
        //store image in photos table
        $organization->photos()->create([
          'image_path' => $file_name,
          'alt' => 'organization photo',
          'description' => 'gallery' ,
          'purpose_id' => $photo_purpose->purpose_id,
        ]);
      }
      //attach user for organization, created at user registration 
      $newOrganizationFlag = $request->session()->pull('newOrganizationFlag', 'default');
      if( $newOrganizationFlag == 1)
      {
        if($organization->users()->sync([Auth::user()->user_id]))
        {
          $role = Role::where('role','organization_manager')->first()->role_id;
          $user = Auth::user();
          $user->role_id = $role;
          $user->save();
          return view('citadel.home')->with('message','Регистрирахте профил и организация успешно!');  
        }
        return view('citadel.home')->with('message','Регистрирахте профил, но регистрацията на организация бе неуспешна! Моля свържете се с нас на team@aktivnosti.bg');
      }
		  //validate organization requests
		  $this->validate($request,[
        'name' => ['required', 'max:255'],
        'description' => ['required', 'max:500'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'address' => ['required', 'string', 'max:255'],
        'website' => ['string', 'max:255'],
        'phone' => ['required','regex:/^[0-9\-\(\)\/\+\s]*$/'], 
        'photo'=> ['nullable','mimes:jpg,png,jpeg,gif,svg','max:2048'],
      ],
		  [
        'name.required' => 'Моля въведете име',
        'email.required' => 'Моля въведете E-mail адрес', 
        'email.email' => 'Моля въведете валиден E-mail адрес',
        'address.required' => 'Моля въведете адрес',
        'phone.regex' => 'Моля въведете валиден телефонен номер',
        'phone.required' => 'Моля въведете телефонен номер',
        'photo.mimes' => 'Формата на изображението не се поддържа',
        'photo.max' => 'Размерът на файла трябва да бъде по-малък от 2MB'
      ]);
      return redirect('citadel/organizations')->with('message', 'Създадена е нова организация');
    }//end of store

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $organization = Organization::findOrFail($id);
		  $purpose = Purpose::select('purpose_id')->where('description','gallery')->first();
		  $gallery =  $organization->photos->where('purpose_id', $purpose->purpose_id);
      return view('organizations.show')->with(compact(['organization','gallery']));
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
		  $purpose = Purpose::select('purpose_id')->where('description','gallery')->first();
		  $gallery =  $organization->photos->where('purpose_id', $purpose->purpose_id);
      //prepare approved options
      $approvals = ($organization->isApproved()) ? $approvals=['1'=> 'Одобрена']+['0' => 'Неодобрена'] : $approvals=['0' => 'Неодобрена']+ ['1'=> 'Одобрена'];
      return view('organizations.edit')->with(compact(['organization','gallery','galleryPhoto','approvals']));
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
      if(Auth::user()->hasAnyRole(['admin','moderator']))
      {
        $organization->approved_at = ($request->get('approved')==1) ? (date('Y-m-d H:i:s')): NULL;
      }
      $organization->save();
		
		  if(isset($request['photo']))
      {
			//delete old photo
        foreach($organization->photos as $photo)
        {
          $old_photo = $photo->image_path;
        }
        //File::delete(public_path().'user_files/images/organization/'.$old_photo);
        // File::delete('user_files/images/organization/'.$old_photo);
        $original_name = $request['photo']->getClientOriginalName();
        $file_name = uniqid().$original_name;
        $store_file = $request['photo']->move('user_files/images/organization', $file_name);
        // $path_to_image = public_path().'/user_files/images/organization'.$file_name;
		  
        $organization->photos()->update([
			 	'image_path' => $file_name
			 ]);
      }
		  //store organization image in public\user_files\images\organization\gallery
      if(isset($request['gallery']))
      {
        $original_name = $request['gallery']->getClientOriginalName();
        $file_name = uniqid().$original_name;
        $store_file = $request['gallery']->move('user_files/images/organization/gallery', $file_name);
        //$path_to_image = '../public/user_files/images/organization/gallery'.$file_name;
        //add organization image to DB
	
        //prepare purposes table if not ready
        $photo_purpose = Purpose::where('description','gallery')->first();
        if(!$photo_purpose)
        {
          $photo_purpose=Purpose::firstOrCreate(['description' => 'gallery']);
        }
        //store image in photos table
        $organization->photos()->create([
          'image_path' => $file_name,
          'alt' => 'organization photo',
          'description' => 'gallery' ,
          'purpose_id' => $photo_purpose->purpose_id,
        ]);
      }
      return redirect()->route('organizations.adminOrg')->with('message', 'Организацията '.$organization->name.' е редактирана!');
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

    public function unApprove($id)
    {
      $organization = Organization::find($id);
      $organization->approved_at = NULL;
      $organization->save();
      return redirect()->back()->with('message', 'Одобрението на организация '.$organization->name.' е отменено!');
    }
	
}
