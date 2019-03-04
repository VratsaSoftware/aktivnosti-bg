<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::group(['middleware' => 'App\Http\Middleware\Citadel'], function(){
	Route::resource('/citadel/users' , 'UsersController');
});

Auth::routes();

Route::get('/citadel', function () {

    return view('auth.login');
});

Route::get('/', function () {

    return view('welcome');
});



