<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ActivityFormRequest;
use App\Models\Activity;
use App\Models\Organization;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Photo;
use App\Models\Purpose;
use App\Models\Group;
use App\Models\Schedule;
use App\Models\City;
use App\Models\User;
use File;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Schema;
use Image;//crop image


class ActivityController extends Controller
{
    public function getSucategories($category)
    {
        $subCategories = SubCategory::where('category_id', $category)->get();

        return response()->json($subCategories);
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $categories=Category::all();

        $age = 0;

        if($request->has('free') and $request->free == 1){
            $priceCondition = "price is NULL";
        }
        else{
            $priceCondition = true;
        }

        if($request->has('age') && $request->age > 0 ){
            $age = $request->age;
            $ageCondition = 'GREATEST(GREATEST(IFNULL(min_age,0),'.$age.')-LEAST(IFNULL(max_age,110),'.$age.'),0)=0';
        }
        else {
            $ageCondition = true;

        }

        if($request->exists('free') || $request->exists('age') ){
            $activities=Activity::whereRaw($priceCondition)->whereRaw($ageCondition)->whereNotNull('approved_at')->get();
        }
        else {

            $activities=Activity::latest()->whereNotNull('approved_at')->where('available',1)->paginate(25)->onEachSide(3);;
        }
    
        return view('activities.index', compact('activities', 'categories'));
    }

    public function manage()
    {

        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')){
            
            $activities=Activity::all();
        
            return view('activities.adminAct', compact('activities'));
        }
        elseif(Auth::user()->hasRole('organization_member') || Auth::user()->hasRole('organization_manager'))
        {
        
            $organizations=Auth::user()->organizations()->get();

            foreach ($organizations as $organization) {
                $organization_id=$organization->organization_id;
            }
            
            if($organizations){
                $activities=Activity::where('organization_id', $organization_id)->get();
                
                return view('activities.adminAct', compact('activities'));
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

        $categories=Category::all();
        $subcategories=SubCategory::all();

        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')){
            
            $organizations = Organization::all();

        
            return view('activities.create', compact('categories', 'subcategories', 'organizations'));
        }
        elseif(Auth::user()->hasRole('organization_member') || Auth::user()->hasRole('organization_manager'))
        {
        
            $organizations=Auth::user()->organizations()->get();
            
            if($organizations){
                
                return view('activities.create', compact('categories', 'subcategories', 'organizations'));
            }
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityFormRequest $request)
    {
        //set default city
        $default_city = City::firstOrCreate(['name' => 'Враца', 'country_id' => '1']); 
        
        $activity = new Activity;
        $activity->name = $request->get('name');
        $activity->description = $request->get('description');
        $activity->price = $request->get('price');
        $activity->min_age = $request->get('min_age');
        $activity->max_age = $request->get('max_age');
        $activity->address = $request->get('address');
        $activity->start_date = $request->get('start_date');
        $activity->end_date = $request->get('end_date');
        $activity->duration = $request->get('duration');
        $activity->requirements = $request->get('requirements');
        $activity->organization_id = $request->get('organization_id');
        $activity->category_id = $request->get('category_id');
        $activity->subcategory_id = $request->get('subcategory_id');
        $activity->available = $request->get('available');
        $activity->fixed_start = $request->get('fixed_start');
        $activity->city_id = $default_city->city_id;
        $activity->save();
        
        // mine picture
        if(isset($request['photo'])){

            $photo = $request->file('photo');
            $original_name = $request['photo']->getClientOriginalName();
            $file_name = uniqid().$original_name;

            //crop image
            $crop = $request->get('crop');                       
            if($crop){                                                                        
                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $crop)); 
                $img = Image::make($info);                                                          
                $img->save(public_path('user_files/images/activity/'.$file_name));             
            } 
            else {

            $store_file = $request['photo']->move('user_files/images/activity/', $file_name);
            }

            $photo_purpose = Purpose::where('description','mine')->first();

            if(!$photo_purpose){

                $photo_purpose=Purpose::firstOrCreate(['description' => 'mine']);
            }

        }

        //store image in photos table   
        $activity->photos()->create([
                'image_path' => $file_name,
                'alt' => 'activity photo',
                'description' => 'activity photo' ,
                'purpose_id' => $photo_purpose->purpose_id,
        ]);

        //store activity image in public\user_files\images\activity
        if(isset($request['gallery'])){

            foreach($request['gallery'] as $gallery){

                $gallery_name = $gallery->getClientOriginalName();
                $file_galery = uniqid().$gallery_name;
                $store_file = $gallery->move('user_files/images/activity', $gallery_name);
                
                $gallery_purpose = Purpose::where('description','gallery')->first();

                if(!$gallery_purpose){

                    $gallery_purpose=Purpose::firstOrCreate(['description' => 'gallery']);
                }

                //store image in photos table
                
                $activity->photos()->create([
                    'image_path' => $gallery_name,
                    'alt' => 'activity photo',
                    'description' => 'gallery' ,
                    'purpose_id' => $gallery_purpose->purpose_id,
                ]);
            }
        }

        return redirect('/citadel/activity')->with('message', 'Създадена е нова активност');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activities=Activity::all();
        $activity = Activity::findOrFail($id);
        $purpose_gallery = Purpose::select('purpose_id')->where('description','gallery')->first();
		$purpose_logo = Purpose::select('purpose_id')->where('description','mine')->first();
		$gallery =  $activity->photos->where('purpose_id', $purpose_gallery->purpose_id);
		$logo =  $activity->photos->where('purpose_id', $purpose_logo->purpose_id);
        return view('activities.show', compact(['activity', 'activities', 'gallery', 'logo' ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $activity = Activity::findOrFail($id);
        $categories=Category::all();
        $subcategories=SubCategory::all();

        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')){
            
            $organizations = Organization::all();

        
            return view('activities.edit', compact('activity', 'categories', 'subcategories', 'organizations'));
        }
        elseif(Auth::user()->hasRole('organization_member') || Auth::user()->hasRole('organization_manager'))
        {
        
            $organizations=Auth::user()->organizations()->get();
            
            if($organizations){
                
                return view('activities.edit', compact('activity', 'categories', 'subcategories', 'organizations'));
            }
        } 

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityFormRequest $request, $id)
    {

        $default_city = City::firstOrCreate(['name' => 'Враца', 'country_id' => '1']); 
        
        $activity = Activity::findOrFail($id);
        $activity->name = $request->get('name');
        $activity->description = $request->get('description');
        $activity->price = $request->get('price');
        $activity->min_age = $request->get('min_age');
        $activity->max_age = $request->get('max_age');
        $activity->address = $request->get('address');
        $activity->start_date = $request->get('start_date');
        $activity->end_date = $request->get('end_date');
        $activity->duration = $request->get('duration');
        $activity->requirements = $request->get('requirements');
        $activity->organization_id = $request->get('organization_id');
        $activity->category_id = $request->get('category_id');
        $activity->subcategory_id = $request->get('subcategory_id');
        $activity->available = $request->get('available');
        $activity->fixed_start = $request->get('fixed_start');
        $activity->city_id = $default_city->city_id;
        
        if(isset($request['photo'])){

            $photo = $request->file('photo');
            $original_name = $request['photo']->getClientOriginalName();
            $file_name = uniqid().$original_name;

            //crop image
            $crop = $request->get('crop');                       
                if($crop){    
				
                    $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $crop)); 
                    $img = Image::make($info);                                                          
                    $img->save(public_path('user_files/images/activity/'.$file_name));             
                } 
                else {

                $store_file = $request['photo']->move('user_files/images/activity/', $file_name);
                }

            $photo_purpose = Purpose::where('description','mine')->first();

            if(!$photo_purpose){

                $photo_purpose=Purpose::firstOrCreate(['description' => 'mine']);
            }
            
        $activity->photos()->update([
                'image_path' => $file_name,
                'alt' => 'activity mine photo',
                'description' => 'mine',
                'purpose_id' => $photo_purpose->purpose_id,
            ]);
        } 

        if(isset($request['gallery'])){

            foreach($request['gallery'] as $gallery){

                $gallery_name = $gallery->getClientOriginalName();
                $file_gallery = uniqid().$gallery_name;
                $store_file = $gallery->move('user_files/images/activity', $file_gallery);
                
                $gallery_purpose = Purpose::where('description','gallery')->first();

                if(!$gallery_purpose){

                    $gallery_purpose=Purpose::firstOrCreate(['description' => 'gallery']);
                }
                
                $activity->photos()->create([
                    'image_path' => $file_gallery ,
                    'alt' => 'activity photo',
                    'description' => 'gallery' ,
                    'purpose_id' => $gallery_purpose->purpose_id,
                ]);
            }
        }

        if(!Auth::user()->hasRole('admin') || !Auth::user()->hasRole('moderator')){


            $activIty->approved_at = NULL;

        }

        $activity->save();

        return redirect('/citadel/activity')->with('message', 'Активност '.$activity->activity_name.' е редактирана');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);
        $activity->delete();

        return redirect()->back()->with('message', 'Активността '.$activity->name.' е изтрита!');

    }
    public function approve($id)
    {
        $activity = Activity::find($id);
        $activity->approved_at = (date('Y-m-d H:i:s'));
        $activity->save();

        return redirect()->back()->with('message', 'Активността '.$activity->name.' е одобрена!');
    }

    public function unApprove($id)
    {
        $activity = Activity::find($id);
        $activity->approved_at = NULL;
        $activity->save();

        return redirect()->back()->with('message', 'Одобрението на активността '.$activity->name.' е отменено!');
    }
}
