<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Http\Requests\OrganizationFormRequest;
use App\Models\Organization;
use App\Models\Photo;
use App\Models\User;
use App\Models\City;
use App\Models\Purpose;
use App\Models\Role;
use App\Models\Activity;
use File;
use Image;//crop image

class OrganizationController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
      //Middleware organizations
        $this->middleware('protect.organization')->except(['index','adminOrg','show','create','store']);;
    } 
	 
    public function index()
    {

		$organizations = Organization::latest()->whereNotNull('approved_at')->paginate(16)->onEachSide(3);
		$purpose_logo = Purpose::select('purpose_id')->where('description','logo')->first();
		$logo =  Photo::all()->where('purpose_id', $purpose_logo->purpose_id);
        return view('organizations.index')->with(compact(['organizations', 'logo']));
    }
	
	public function adminOrg()
    {
		if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')){
			
			$organizations = Organization::all();

            if(Auth::user()->hasRole('moderator')){

                $userCategories = Auth::user()->categories->pluck('category_id')->toArray();
                $organizations = $organizations->filter(function($organizations) use ($userCategories){
                $activities = $organizations->activities->pluck('category_id')->toArray();
                    foreach ($userCategories as $key => $value){
                        if(in_array($value,$activities)){
                            return true;
                    }
                }
                return false;       
                });
            }

			return view('organizations.adminOrg', compact('organizations'));
		}
		elseif(Auth::user()->hasRole('organization_member') || Auth::user()->hasRole('organization_manager'))
		{
		
			$organizations=Auth::user()->organizations()->orderBy('name')->get();
			
			if($organizations){
				
				return view('organizations.adminOrg', compact('organizations'));
			}
		}    
	
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function create()
    {
        $newOrganizationFlag = NULL;
        (session('newOrganizationFlag')) ? $newOrganizationFlag = session('newOrganizationFlag') : '';

        return view('organizations.create')->with('newOrganizationFlag',$newOrganizationFlag);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationFormRequest $request)
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
            //add organization image to DB
            //prepare purposes table if not ready
			$crop = $request->get('crop');                                              //crop image
			if($crop){																		//crop image
				$info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $crop)); //crop image
				$img = Image::make($info);                                                          //crop image
				$img->save(public_path('user_files/images/organization/'.$file_name));              //crop image
			}else{
				$store_file = $request['photo']->move('user_files/images/organization', $file_name);
			}
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
		//store organization image in public\user_files\images\organization\gallery
        if(isset($request['gallery'])){
			foreach($request['gallery'] as $gallery){
				$gallery_name = $gallery->getClientOriginalName();
				$file_galery = uniqid().$gallery_name;
				$store_file = $gallery->move('user_files/images/organization/gallery', $gallery_name);
				//$path_to_image = '../public/user_files/images/organization/gallery'.$gallery_name;
				//add organization image to DB
				//prepare purposes table if not ready
				$gallery_purpose = Purpose::where('description','gallery')->first();
				if(!$gallery_purpose){
					$gallery_purpose=Purpose::firstOrCreate(['description' => 'gallery']);
				}

				//store image in photos table
				
				$organization->photos()->create([
					'image_path' => $gallery_name,
					'alt' => 'organization photo',
					'description' => 'gallery' ,
					'purpose_id' => $gallery_purpose->purpose_id,
				]);
			}
        }

        //attach user for organization, created at user registration 
        $newOrganizationFlag = $request->session()->pull('newOrganizationFlag', 'default');
        if( $newOrganizationFlag == 1){
            if($organization->users()->sync([Auth::user()->user_id]))
            {
            $role = Role::where('role','organization_manager')->first()->role_id;
            $user = Auth::user();
            $user->role_id = $role;
            $user->save();
                if($request->get('activity') == 1){
                    session(['newActivityFlag' => 1]);
                    return redirect()->action('ActivityController@create');
                }

                return view('citadel.home')->with('message','Регистрирахте профил и организация успешно!');  
            }
            else
            {
                return view('citadel.home')->with('message','Регистрирахте профил, но регистрацията на организация бе неуспешна! Моля свържете се с нас на team@aktivnosti.bg');
            } 
        }

        return redirect('citadel/organizations')->with('message', 'Създадена е нова организация');
    }//end of create

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organization = Organization::findOrFail($id);
		$activities = Activity::where('organization_id', $id)->where('available',1)->where('approved_at','!=', null)->where('category_id','!=',null)->whereRaw('start_date  <= curdate() and IFNULL(end_date,curdate()+1) >= curdate()')->get();
		$purpose_gallery = Purpose::select('purpose_id')->where('description','gallery')->first();
		$purpose_logo = Purpose::select('purpose_id')->where('description','logo')->first();
		$gallery =  $organization->photos->where('purpose_id', $purpose_gallery->purpose_id);
		$logo =  $organization->photos->where('purpose_id', $purpose_logo->purpose_id);
		
        return view('organizations.show')->with(compact(['organization','gallery','logo', 'activities']));
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
		$purpose_logo = Purpose::select('purpose_id')->where('description','logo')->first();
		$logo =  $organization->photos->where('purpose_id', $purpose_logo->purpose_id);
		
        //prepare approved options
		$approvals = ($organization->isApproved()) ? $approvals=['1'=> 'Одобрена']+['0' => 'Неодобрена'] : $approvals=['0' => 'Неодобрена']+ ['1'=> 'Одобрена'];
		return view('organizations.edit')->with(compact(['organization','gallery','logo','approvals']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizationFormRequest $request, $id)
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
       
		if(Auth::user()->hasAnyRole(['admin','moderator'])){
			
			$organization->approved_at = ($request->get('approved')==1) ? (date('Y-m-d H:i:s')): NULL;
		}
		
		$organization->save();
		
		
		$purpose_logo = Purpose::select('purpose_id')->where('description','logo')->first();
		$logo =  $organization->photos->where('purpose_id', $purpose_logo->purpose_id);  
		
		if(isset($request['photo'])){
			
			
	
            $original_name = $request['photo']->getClientOriginalName();
			$file_name = uniqid().$original_name;
            //add organization image to DB
            //prepare purposes table if not ready
			$crop= $request->get('crop');
			if($crop){
				$info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $crop));
				$img = Image::make($info);
				$img->save(public_path('user_files/images/organization/'.$file_name));
			}else{
				$store_file = $request['photo']->move('user_files/images/organization', $file_name);
			}
            $photo_purpose = Purpose::where('description','logo')->first();
            if(!$photo_purpose){
                $photo_purpose=Purpose::firstOrCreate(['description' => 'logo']);
            }
		
			
			if(count($logo)<1){
				$organization->photos()->create([
                'image_path' => $file_name,
                'alt' => 'organization photo',
                'description' => 'logo' ,
                'purpose_id' => $photo_purpose->purpose_id,
				]);
            }
            else
            {
                $organization->photos()->update([
				'image_path' => $file_name
				]);
				
				//delete old photo
				foreach($organization->photos as $photo){
					$old_photo = $photo->image_path;
					File::delete('user_files/images/organization/'.$old_photo);
				}	  
            }
		}
		
        //store organization image in public\user_files\images\organization\gallery
        if(isset($request['gallery'])){
			foreach($request['gallery'] as $gallery){
				$gallery_name = $gallery->getClientOriginalName();
				$file_galery = uniqid().$gallery_name;
				$store_file = $gallery->move('user_files/images/organization/gallery/', $file_galery);
				//$path_to_image = '../public/user_files/images/organization/gallery'.$gallery_name;
				//add organization image to DB
				//prepare purposes table if not ready
				$gallery_purpose = Purpose::where('description','gallery')->first();
				if(!$gallery_purpose){
					$gallery_purpose=Purpose::firstOrCreate(['description' => 'gallery']);
				}

				//store image in photos table
				
				$organization->photos()->create([
					'image_path' => $file_galery ,
					'alt' => 'organization photo',
					'description' => 'gallery' ,
					'purpose_id' => $gallery_purpose->purpose_id,
				]);
			}
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
        //delete news
		foreach($organization->news as $news){
			$news->delete();
		}
		$organization->delete();
        return redirect()->back()->with('message', 'Организацията '.$organization->name.' е изтрита!');
    }
	/**
     * Appruve organization.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function approve($id)
    {
        $organization = Organization::find($id);
        $organization->approved_at = (date('Y-m-d H:i:s'));
        $organization->save();
        return redirect()->back()->with('message', 'Организацията '.$organization->name.' е одобрена!');
    }
	
	/**
     * Unappruve organization.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function unApprove($id)
    {
      $organization = Organization::find($id);
      $organization->approved_at = NULL;
      $user->updated_by = Auth::user()->email;
      $organization->save();
      return redirect()->back()->with('message', 'Одобрението на организация '.$organization->name.' е отменено!');
    }
	 /**
     * Remove photo from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroyGallery($id)
    {
		$photoGallery = Photo::find($id);
		//delete old photo
		foreach($photoGallery  as $photo){
			$old_photo = $photoGallery->image_path;
			File::delete('user_files/images/organization/gallery/'.$old_photo);
		}
		$photoGallery->delete();
        return redirect()->back();
    }
}
