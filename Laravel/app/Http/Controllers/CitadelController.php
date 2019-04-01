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

            return view('citadel.home');
        } 
        else
        {
            if ($request->user()->hasRole('admin')) {
                //redirect admin to administrator view
                $users         = User::all()->where('deleted_at', null)->where('approved_at', null);
                $organizations = Organization::all()->where('deleted_at', null)->where('approved_at', null);
                return view('citadel.index', compact('users', 'organizations','purposeLogo'));
    
            } 
            elseif($request->user()->hasRole('moderator'))
            {
                //!will be modified after Organization implementation
                //will return only Organizations with same activities category as moderator
                $users = User::all()->where('deleted_at', null)->where('approved_at', null);
                $organizations = Organization::all()->where('deleted_at', null)->where('approved_at', null);
                return view('citadel.index', compact('organizations','users','purposeLogo'));

            }
            elseif($request->user()->hasRole('organization_manager') || $request->user()->hasRole('organization_memeber')) {
                $organizations=Auth::user()->organizations()->orderBy('name')->get();
                return view('citadel.index', compact('organizations','users','purposeLogo'));
            }
            else
            {
                return view('citadel.home');
            }
        }
    }
}
