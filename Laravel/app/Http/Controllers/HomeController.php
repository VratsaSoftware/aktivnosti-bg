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
        $newOrganizationFlag = session('newOrganizationFlag', NULL);

        if($newOrganizationFlag == 1)
        {
            return redirect()->action('OrganizationController@create');
        }
        
        if($request->user()->hasRole('admin') && $request->user()->isApproved()){

            return redirect()->action('UsersController@index');

        }
        else{
             return view('citadel.home');
        }
    }

    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {   
        //
    }
  
}
