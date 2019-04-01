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
		Route::get('/citadel','CitadelController@index')->name('citadel.index');

		//users management, admin side
		Route::resource('/citadel/users', 'UsersController');

		//users management
		Route::resource('/citadel/profile', 'ProfileController');

		//dispatch approve method in Users Controller 
		Route::get('citadel/users/approve/{id}', 'UsersController@approve')->name('users.approve');

		//organizations management
		Route::resource('/citadel/organizations', 'OrganizationController');

		//dispatch approve method in Organizations Controller 
		Route::get('citadel/organizations/approve/{id}', 'OrganizationController@approve')->name('organizations.approve');

		//activities management
		Route::resource('/citadel/activity', 'ActivityController');	

		//news management
		Route::resource('/citadel/news', 'NewsController');	

		//subscriptions management
		Route::resource('/citadel/subscription', 'NewsController');	
	});

});

Auth::routes();

// Route::resource('/', 'ActivityController');
Route::get('/', 'ActivityController@showAllActivities');
Route::get('/1', 'ActivityController@showSingleActivity');
Route::get('/calendar', 'ActivityController@showCalendar');

// Route::resource('organization', 'OrganizationController');
Route::get('organization', 'OrganizationController@showOrganization');

// Route::resource('news', 'NewsController');
Route::get('news', 'NewsController@showAllNews');
Route::get('/news', 'NewsController@showAllNews');

//for test purposes, will be deleted later
Route::get('/test','TestController@index')->name('test.index');






