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



//authentication 
Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home');

	//logged users access control
    Route::group(['middleware' => 'citadel.entry'], function () {
		Route::get('/citadel','CitadelController@index');
	});

});

Auth::routes();

//main page
Route::get('/', function () {
    return view('welcome');
});

//for test purposes, will be deleted later
Route::get('/test','TestController@index');





