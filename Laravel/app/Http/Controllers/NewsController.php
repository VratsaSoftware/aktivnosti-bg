<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Http\Requests\NewsFormRequest;
use App\Models\Organization;
use App\Models\Photo;
use App\Models\User;
use App\Models\Purpose;
use App\Models\Role;
use App\Models\Activity;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Arr;
use File;
use Image;//crop image

class NewsController extends Controller
{
    // temp function
    
    public function adminNews()
    {
        $news = News::all();
		$purpose = Purpose::select('purpose_id')->where('description','front')->first();
		$news_photo =  Photo::all()->where('purpose_id', $purpose->purpose_id);
        return view('news.adminNews')->with(compact(['news', 'news_photo']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->whereNotNull('approved_at')->paginate(9)->onEachSide(3);
		$purpose = Purpose::select('purpose_id')->where('description','front')->first();
		$news_photo =  Photo::all()->where('purpose_id', $purpose->purpose_id);
        return view('news.index')->with(compact(['news', 'news_photo']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$categories = [ 0 => 'Изберете Категория'] + (Category::select('category_id','name')->pluck('name','category_id')->toArray());

        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')){
            
            $organizations = [ 0 => 'Изберете Организация'] + (Organization::select('organization_id','name')->whereNotNull('approved_at')->pluck('name','organization_id')->toArray());
			
        
            return view('news.create', compact('categories', 'subcategories', 'organizations'));
        }
        elseif(Auth::user()->hasRole('organization_member') || Auth::user()->hasRole('organization_manager'))
        {
        
            $organizations=Auth::user()->organizations()->get();
            
            if($organizations){
                
                return view('news.create', compact('categories', 'subcategories', 'organizations'));
            }
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsFormRequest $request)
    {
		
		if($request['category']&&($request['organization_id'] == 0)){
			
			$news_type = Category::find($request['category']);
			
		}elseif($request['organization_id']&&($request['activity'] == null)){
			
			$news_type = Organization::find($request['organization_id']);
			
		}elseif($request['activity']){
			
			$news_type = Activity::find($request['activity']);
			
		}else{
			$news_type = Organization::where('name', 'aktivnosti.bg')->whereNotNull('approved_at')->get(1);
		}
		$news_type->news()->create([
			'heading' => $request->get('name'),
			'created_by' => Auth::user()->name,
			'description' => $request->get('description'),
			'date' => $request->get('start_date'),
        ]);
		$news = $news_type->news->last();
		 //store news image in public\user_files\images\news
        if(isset($request['photo'])){
            $original_name = $request['photo']->getClientOriginalName();
			$file_name = uniqid().$original_name;
            //add news image to DB
            //prepare purposes table if not ready
			$crop = $request->get('crop');                                              //crop image
			if($crop){																		//crop image
				$info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $crop)); //crop image
				$img = Image::make($info);                                                          //crop image
				$img->save(public_path('user_files/images/news/'.$file_name));              //crop image
			}else{
				$store_file = $request['photo']->move('user_files/images/news', $file_name);
			}
            $photo_purpose = Purpose::where('description','front')->first();
            if(!$photo_purpose){
                $photo_purpose=Purpose::firstOrCreate(['description' => 'front']);
            }

            //store image in photos table
            $news->photos()->create([
                'image_path' => $file_name,
                'alt' => 'news photo',
                'description' => 'news photo' ,
                'purpose_id' => $photo_purpose->purpose_id,
            ]);
        }
				
        return redirect('citadel/news')->with('message', 'Създадена е Новина');
    }//end of create

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::findOrFail($id);
		$purpose = Purpose::select('purpose_id')->where('description','front')->first();
		$news_photo =  $news->photos->where('purpose_id', $purpose->purpose_id);
		
		return view('news.show')->with(compact(['news','news_photo']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
		$purpose = Purpose::select('purpose_id')->where('description','front')->first();
		$news_photo =  $news->photos->where('purpose_id', $purpose->purpose_id);
		
		//prepare approved options
		$approvals = ($news->isApproved()) ? $approvals=['1'=> 'Одобрена']+['0' => 'Неодобрена'] : $approvals=['0' => 'Неодобрена']+ ['1'=> 'Одобрена'];
		
		$categories = [ 0 => 'Изберете Категория'] + (Category::select('category_id','name')->pluck('name','category_id')->toArray());

        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')){
            
            $organizations = [ 0 => 'Изберете Организация'] + (Organization::select('organization_id','name')->whereNotNull('approved_at')->pluck('name','organization_id')->toArray());
			
        
            return view('news.edit', compact('news', 'categories', 'subcategories', 'organizations', 'approvals'));
        }
        elseif(Auth::user()->hasRole('organization_member') || Auth::user()->hasRole('organization_manager'))
        {
        
            $organizations=Auth::user()->organizations()->get();
            
            if($organizations){
                
                return view('news.edit', compact('news', 'categories', 'subcategories', 'organizations', 'approvals'));
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
    public function update(Request $request, $id)
    {
		
		$news = News::findOrFail($id) ;
		$article_type = $news->article_type;
		$article_id = $news->article_id;
		if($request['category']&&($request['organization_id'] == 0)){
			
			$news_type = Category::find($request['category']);
			$article_type = 'App\Models\Category';
			$article_id = $news_type->category_id;
			
		}elseif($request['organization_id']&&($request['activity'] == null)){
			
			$news_type = Organization::find($request['organization_id']);
			$article_type = 'App\Models\Organization';
			$article_id = $news_type->organization_id;
			
		}elseif($request['activity']){
			
			$news_type = Activity::find($request['activity']);
			$article_type = 'App\Models\Activity';
			$article_id = $news_type->activity_id;
		}
				
		$news->update([
			'heading' => $request->get('name'),
			'description' => $request->get('description'),
			'date' => $request->get('start_date'),
			'article_id' => $article_id,
			'article_type' => $article_type,
        ]);
		
		 //store news image in public\user_files\images\news
        if(isset($request['photo'])){
            $original_name = $request['photo']->getClientOriginalName();
			$file_name = uniqid().$original_name;
            //add news image to DB
            //prepare purposes table if not ready
			$crop = $request->get('crop');                                              //crop image
			if($crop){																		//crop image
				$info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $crop)); //crop image
				$img = Image::make($info);                                                          //crop image
				$img->save(public_path('user_files/images/news/'.$file_name));              //crop image
			}else{
				$store_file = $request['photo']->move('user_files/images/news', $file_name);
			}
            $photo_purpose = Purpose::where('description','front')->first();
            if(!$photo_purpose){
                $photo_purpose=Purpose::firstOrCreate(['description' => 'front']);
            }
			
			$purpose = Purpose::select('purpose_id')->where('description','front')->first();
			$news_photo =  $news->photos->where('purpose_id', $purpose->purpose_id);
			if(count($news_photo)<1){
				$news->photos()->create([
                'image_path' => $file_name,
                'alt' => 'news photo',
                'description' => 'front' ,
                'purpose_id' => $photo_purpose->purpose_id,
				]);
            }
            else
            {
                $news->photos()->update([
				'image_path' => $file_name
				]);
				
				//delete old photo
				foreach($news->photos as $photo){
					$old_photo = $photo->image_path;
					File::delete('user_files/images/news/'.$old_photo);
				}	  
            }
            //store image in photos table
		}
		if(!Auth::user()->hasRole('admin') || !Auth::user()->hasRole('moderator')){
           
			$news->approved_at = NULL;
			$news->save();
        }

        
		return redirect()->route('news.adminNews')->with('message', 'Новината '.$news->heading.' е редактирана!');
    }
	/**
     * Appruve news.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function approve($id)
    {
        $news = News::find($id);
		$news->approved_at = (date('Y-m-d H:i:s'));
		$news->approved_by = Auth::user()->name;
        $news->save();
        return redirect()->back()->with('message', 'Новината '.$news->heading.' е одобрена!');
    }
	/**
     * Unappruve news.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function unApprove($id)
    {
        $news = News::find($id);
        $news->approved_at = NULL;
        $news->save();

        return redirect()->back()->with('message', 'Одобрението на новината '. $news->heading.' е отменено!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
        return redirect()->back()->with('message', 'Новината '.$news->name.' е изтрита!');
    }
	/**
     * get activities 
     * 
     * Ajax
     * dropdown
     */
	public function getActivities($organization, $activity = NULL)
    {
        if($organization == 0){
            return response()->json(array(['activity_id' => '0', 'name' => 'Първо изберете Организация']));
        }

        if(isset($activity)){
            $orderByCondition = $activity;
        } 
        else{
            $orderByCondition = "NULL";
            $blankActArr = array('activity_id' => '0', 'name' => 'Моля изберете активност');
        }
        
        $activities = Activity::select('activity_id','name')->where('organization_id', $organization)->orderByRaw("activity_id = ".$orderByCondition." desc, activity_id asc")->get()->toArray();

        isset($blankActArr) ? $activities = Arr::prepend($activities,$blankActArr) : false;
    
        return response()->json($activities);
    }
}
