<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    //  */
    
    public function index(Request $request)
    {
        if(!$request->user()->isApproved()){

            return view('home');

        }
        elseif($request->user()->hasRole('admin') && $request->user()->isApproved()){

            return redirect()->action('UsersController@index');

        }

    }
  
}
