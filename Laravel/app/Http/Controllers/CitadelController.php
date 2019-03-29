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

        if (!$request->user()->isApproved()) {

            return view('citadel.home');
        } 
        else
        {
            if ($request->user()->hasRole('admin')) {
                //redirect admin to administrator view
                $users         = User::all()->where('deleted_at', null)->where('approved_at', null);
                $organizations = Organization::all()->where('deleted_at', null)->where('approved_at', null);
                $purpose_id = Purpose::select('purpose_id')->where('description','profile')->first()->purpose_id;
                return view('citadel.index', compact('users', 'organizations','purpose_id'));
    
            } 
            elseif($request->user()->hasRole('moderator'))
            {
                $users         = User::all()->where('deleted_at', null)->where('approved_at', null);
                $organizations = Organization::all()->where('deleted_at', null)->where('approved_at', null);
                $purpose_id = Purpose::select('purpose_id')->where('description','logo')->first()->purpose_id;
                return view('citadel.index', compact('organizations','users','purpose_id'));

            }
            elseif($request->user()->hasRole('organization_manager') || $request->user()->hasRole('organization_memeber')) {
                dd($organizations=Auth::user()->organizations()->orderBy('name')->get());
                return view('citadel.index', compact('organizations'));
            }
            else{
                return view('citadel.home')->with('message', 'Акаунтът ви ще бъде активиран скоро!');
            }
        }
    }
}
