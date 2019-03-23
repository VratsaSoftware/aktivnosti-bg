<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitadelController extends Controller
{
    public function index(Request $request){

    	if(!$request->user()->isApproved()){

            return view('home');

        }
        elseif($request->user()->hasRole('admin') && $request->user()->isApproved()){

            return redirect()->action('UsersController@index');

        }

        else{
        	return view('home')->with('message', 'За обработка, потребителят не е одобрен или е с роля различна от админ');
        }
    }
}
