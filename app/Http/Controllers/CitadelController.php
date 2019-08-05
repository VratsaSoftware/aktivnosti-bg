<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\Purpose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitadelController extends Controller
{
    public function index(Request $request)
    {
        $purposeLogo = Purpose::select('purpose_id')->where('description','logo')->first()->purpose_id;
    
        if (!$request->user()->isApproved()) {
            //send not approved users to home
            return view('citadel.home'); 
        }

        if ($request->user()->hasRole('admin')) {
            //redirect admin to administrator view
            $users         = User::all()->where('deleted_at', null)->where('approved_at', null);
            $organizations = Organization::all()->where('deleted_at', null)->where('approved_at', null);
            return view('citadel.index', compact('users', 'organizations','purposeLogo'));
        }

        if($request->user()->hasRole('moderator'))
        {
  
            $userCategories = Auth::user()->categories->pluck('category_id')->toArray();

            $users = User::all()->where('deleted_at', null)->where('approved_at', null);

            $organizations = Organization::all()->where('deleted_at', null)->where('approved_at', null)->filter(function($organizations) use ($userCategories){
                $activities = $organizations->activities->pluck('category_id')->toArray();
                    foreach ($userCategories as $key => $value){
                        if(in_array($value,$activities)){
                            return true;
                    }
                }
                return false;       
            });

            return view('citadel.index', compact('organizations','users','purposeLogo'));
        }

        if($request->user()->hasRole('organization_manager') || $request->user()->hasRole('organization_memeber')) {

            $organizations=Auth::user()->organizations()->orderBy('name')->get();

            //prepare data for organization_manager index page 
            if($request->user()->hasRole('organization_manager')){
                $users = collect([]);
                $allUsers = collect([]);
                foreach($organizations as $organization){ 
                    foreach ( $organization->users as $user) {
                        if($user->deleted_at == null && $user->approved_at == null){
                        $users->push($user);
                        }
                        $allUsers->push($user);
                    }
                }
            }

            return view('citadel.index', compact('organizations','users','purposeLogo','allUsers'));
        }
            
        return view('citadel.home');
    }
}
