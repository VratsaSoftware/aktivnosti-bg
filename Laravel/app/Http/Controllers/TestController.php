<?php
//for test purposes
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Organization;
use App\Models\Group;
use App\Models\Schedule;
use App\Models\User;

class TestController extends Controller
{
    public function index(){
    	echo "<p>TestController</p>";
    	$user = User::find(7);
    	$activity = Activity::find(1);
    	$activity->organization->organization_id;
    	$user_organization = $user->organizations->first()->organization_id;
    	dd($user->photo->image_path);
    }
}
