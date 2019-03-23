<?php
//for test purposes
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Organization;
use App\Models\Group;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index(){
    	echo "<p>TestController</p>";
    	$user = User::find(10);
    	$activity = Activity::find(1);
    	$organization = Organization::find(1);
    	
        
 
    



    }
}
