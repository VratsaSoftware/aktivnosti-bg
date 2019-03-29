<?php
//for test purposes
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Activity;
use App\Models\Organization;
use App\Models\Group;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Models\Purpose;



class TestController extends Controller
{
    public function index(){
    	echo "<p>TestController</p>";
    	$user = User::find(39);
    	$activity = Activity::find(1);
    	$organization = Organization::find(1);
    	$photo = Photo::find(1);
    	$purpose_id =2;
    	// dd(Route::currentRouteName());
    	// dd($organization->photos->where('purpose_id',$purpose_id)->first()->image_path);
       // dd($user->categories()->sync([1,2,3]));
       // dd(Organization::all()->pluck('name','organization_id')->toArray());\
        dd($user->organizations()->orderBy('name')->get());
        
 
    



    }
}
