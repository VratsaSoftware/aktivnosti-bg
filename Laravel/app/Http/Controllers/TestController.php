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
use App\Models\Role;




class TestController extends Controller
{
    public function index(){
    	echo "<p>TestController</p>";
    	$user = User::find(1);
    	$array = $user->organizations()->pluck('organizations.organization_id')->toArray();
    	var_dump($array);
    	
    	// dd($organization = Organization::with([$user])->get()
    	
    


    }
}
