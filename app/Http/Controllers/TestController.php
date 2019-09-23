<?php
//for test purposes
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Activity;
use App\Models\Organization;
use App\Models\Group;
use App\Models\Schedule;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Models\Purpose;
use App\Models\Role;
use Carbon\Carbon;



class TestController extends Controller
{
    public function index(){

        // $organization = Organization::find(2);
        // var_dump($organization->name);
        // foreach($organization->photos as $photo){
        //     echo '<pre>';
        //     var_dump($photo->photo_id);
        //     var_dump($photo->image_path);
        //     var_dump($photo->purpose->description);
        //     echo '</br>';
        //     echo '</pre>';

            // print($photo->purpose->description);
        //}
        var_dump(Auth::user()->email);



    }
}
