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
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Schema;
use Image;//crop image


class ActivityController extends Controller
{
    public function __construct(){
      //Middleware activities
        $this->middleware('protect.activity')->except(['index','manage','getSucategories','show','create','store']);
    }

    public function getSucategories($category, $subcategory = NULL)
    {
        if($category == 0){

            return response()->json(array(['subcategory_id' => '0', 'name' => 'Първо изберете категория']));
        }

        if(isset($subcategory)){
            $orderByCondition = $subcategory;
        }
        else{
            $orderByCondition = "NULL";
            $blankSubCatArr = array('subcategory_id' => '0', 'name' => 'Моля изберете подкатегория');
        }

        $subCategories = Subcategory::select('subcategory_id','name')->where('category_id', $category)->orderByRaw("subcategory_id = ".$orderByCondition." desc, subcategory_id asc")->get()->toArray();

        isset($blankSubCatArr) ? $subCategories = Arr::prepend($subCategories,$blankSubCatArr) : false;

        return response()->json($subCategories);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public function index(Request $request){

		//Be careful here :)
        //Changes affects front page
        $categories=Category::all();
		$activities = new Activity;

		$request->session()->put('free', $request->has('free') ? $request->get('free') : ($request->session()->has('free') ?$request->session()->get('free') : 0));
		$request->session()->put('cat', $request->has('cat') ? $request->get('cat') : ($request->session()->has('cat') ? $request->session()->get('cat') : 0));
		$request->session()->put('age', $request->has('age') ? $request->get('age') : ($request->session()->has('age') ?$request->session()->get('age') : 0));

		if($request->session()->get('free') > 0 ){
            $priceCondition = "price is NULL";
        }
        else{
            $priceCondition = true;
        }

		if($request->session()->get('age') > 0 ){
			$age = $request->session()->get('age');
			$ageCondition = 'GREATEST(GREATEST(IFNULL(min_age,0),'.$age.')-LEAST(IFNULL(max_age,110),'.$age.'),0)=0';

        }else{
			$ageCondition = true;
		}


		if ($request->session()->get('cat')>0){
			$activities=$activities->where('category_id', $request->session()->get('cat'));
			$activities=$activities->latest()->where('available',1)->whereRaw($priceCondition)->whereRaw($ageCondition)->whereNotNull('approved_at')->whereNotNull('category_id')->whereRaw('IFNULL(end_date,curdate()+1) >= curdate()')->paginate(42)->onEachSide(3);
		}else{
			$activities=$activities->latest()->where('available',1)->whereRaw($priceCondition)->whereRaw($ageCondition)->whereNotNull('approved_at')->whereNotNull('category_id')->whereRaw('IFNULL(end_date,curdate()+1) >= curdate()')->paginate(24)->onEachSide(3);
		}

        if ($request->ajax()){
            return view('activities.index', compact('activities', 'categories'));

        }else{

			$request->session()->flush();
			$activities = new Activity;
			$activities=$activities->latest()->where('available',1)->whereNotNull('approved_at')->whereNotNull('category_id')->whereRaw('IFNULL(end_date,curdate()+1) >= curdate()')->paginate(24)->onEachSide(3);

            return view('activities.ajax', compact('activities', 'categories'));
		}

	}
    public function manage()
    {

        if(Auth::user()->hasRole('admin')){

            $activities=Activity::all();

            return view('activities.adminAct', compact('activities'));
        }
        elseif(Auth::user()->hasRole('moderator')){
            $userCategories = Auth::user()->categories->pluck('category_id')->toArray();
            $activities=Activity::whereIn('category_id',$userCategories)->get();
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
        $categories = [ 0 => 'Изберете Категория'] + (Category::select('category_id','name')->pluck('name','category_id')->toArray());

        //in case of new user->organization->activity registration
        $newActivityFlag = 0;
        (session('newActivityFlag')) ? $newActivityFlag = session('newActivityFlag') : '';

        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')){

            $organizations = Organization::all();


            return view('activities.create', compact('categories', 'subcategories', 'organizations','newActivityFlag'));
        }

        elseif(Auth::user()->hasRole('organization_member') || Auth::user()->hasRole('organization_manager'))
        {

            $organizations=Auth::user()->organizations()->get();

            if($organizations){

                return view('activities.create', compact('categories', 'subcategories', 'organizations','newActivityFlag'));
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

        if(!empty($request->get('category_id')) && $request->get('category_id') != 0){
            $activity->category_id = $request->get('category_id');
        }
        if(!empty($request->get('subcategory_id')) && $request->get('subcategory_id') != 0){
            $activity->subcategory_id = $request->get('subcategory_id');
        }
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
			 //store image in photos table
			$activity->photos()->create([
					'image_path' => $file_name,
					'alt' => 'activity photo',
					'description' => 'activity photo' ,
					'purpose_id' => $photo_purpose->purpose_id,
			]);

        }

        //store activity image in public\user_files\images\activity
        if(isset($request['gallery'])){

            foreach($request['gallery'] as $gallery){

                $gallery_name = $gallery->getClientOriginalName();
                $file_galery = uniqid().$gallery_name;
                $store_file = $gallery->move('user_files/images/activity/gallery', $gallery_name);

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

        //when method is called during the registration process
        $newActivityFlag = $request->session()->pull('newActivityFlag', 'default');
        if($newActivityFlag == 1){

            return view('citadel.home')->with('message','Регистрирахте профил,организация и активност успешно!');
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
        $activities=Activity::where('available',1)->where('approved_at','!=', null)->where('category_id','!=',null)->whereRaw('start_date  <= curdate() and IFNULL(end_date,curdate()+1) >= curdate()')->get();
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
		$purpose = Purpose::select('purpose_id')->where('description','gallery')->first();
		$gallery =  $activity->photos->where('purpose_id', $purpose->purpose_id);
        $haveCategory = (isset($activity->category->category_id) ? [$activity->category->category_id => $activity->category->name ] : [ 0 => 'Изберете Категория'] );

        $categories = $haveCategory + (Category::select('category_id','name')->pluck('name','category_id')->toArray());

        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')){
            $organizations = Organization::all();
            return view('activities.edit', compact('activity', 'categories', 'subcategories', 'organizations', 'gallery'));
        }
        elseif(Auth::user()->hasRole('organization_member') || Auth::user()->hasRole('organization_manager'))
        {
            $organizations=Auth::user()->organizations()->get();
            if($organizations){
                return view('activities.edit', compact('activity', 'categories', 'subcategories', 'organizations','gallery'));
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
        if(!empty($request->get('category_id')) && $request->get('category_id') != 0){
            $activity->category_id = $request->get('category_id');
        }
        if(!empty($request->get('subcategory_id')) && $request->get('subcategory_id') != 0){
            $activity->subcategory_id = $request->get('subcategory_id');
        }
        $activity->available = $request->get('available');
        $activity->fixed_start = $request->get('fixed_start');
        $activity->city_id = $default_city->city_id;

		$purpose_mine = Purpose::select('purpose_id')->where('description','mine')->first();
		$mine =  $activity->photos->where('purpose_id', $purpose_mine->purpose_id);
        if(isset($request['photo'])) {

            $photo = $request->file('photo');
            $original_name = $request['photo']->getClientOriginalName();
            $file_name = uniqid() . $original_name;

            //crop image
            $crop = $request->get('crop');
            if ($crop) {

                $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $crop));
                $img = Image::make($info);
                $img->save(public_path('user_files/images/activity/' . $file_name));
            } else {

                $store_file = $request['photo']->move('user_files/images/activity/', $file_name);
            }

            $photo_purpose = Purpose::where('description', 'mine')->first();

            if (!$photo_purpose) {

                $photo_purpose = Purpose::firstOrCreate(['description' => 'mine']);
            }



			if(count($mine)<1){
				$activity->photos()->update([
                'image_path' => $file_name,
                'alt' => 'activity mine photo',
                'description' => 'mine',
                'purpose_id' => $photo_purpose->purpose_id,
                ]);
            }
            else
            {
                $activity->photos()->update([
				'image_path' => $file_name
				]);

				//delete old photo
				foreach($activity->photos as $photo){
					$old_photo = $photo->image_path;

					File::delete('user_files/images/activity/'.$old_photo);
				}
            }
        }

        if(isset($request['gallery'])){

            foreach($request['gallery'] as $gallery){

                $gallery_name = $gallery->getClientOriginalName();
                $file_gallery = uniqid().$gallery_name;
                $store_file = $gallery->move('user_files/images/activity/gallery', $file_gallery);

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

        //disabled unapproved on edit. will be used later
        // if(!Auth::user()->hasRole('admin') || !Auth::user()->hasRole('moderator')){

        //     $activity->approved_at = NULL;

        // }

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
		//delete news
		foreach($activity ->news as $news){
			$news->delete();
		}

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
        $activity->updated_by = Auth::user()->email;
        $activity->save();

        return redirect()->back()->with('message', 'Одобрението на активността '.$activity->name.' е отменено!');
    }
	public function destroyGallery($id)
    {
		$photoGallery = Photo::find($id);
		//delete old photo
		foreach($photoGallery as $photo){
			$old_photo = $photoGallery->image_path;
			File::delete('user_files/images/activity/gallery/'.$old_photo);
		}
		$photoGallery->delete();
        return redirect()->back();
    }
}
