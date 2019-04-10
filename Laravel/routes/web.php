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
		
		//organizations management
		Route::resource('/citadel/organizations', 'OrganizationController');
		Route::get('citadel/organizations', 'OrganizationController@adminOrg')->name('organizations.adminOrg');

		//users management
		Route::resource('/citadel/profile', 'ProfileController');
		
		//dispatch approve method in Users Controller 
		Route::get('citadel/users/approve/{id}', 'UsersController@approve')->name('users.approve');

		//dispatch unApprove method in Users Controller 
		Route::get('citadel/users/unApprove/{id}', 'UsersController@unApprove')->name('users.unApprove');

		//dispatch approve method in Organizations Controller 
		Route::get('citadel/organizations/approve/{id}', 'OrganizationController@approve')->name('organizations.approve');

		//dispatch unApprove method in Organizations Controller 
		Route::get('citadel/organizations/unAapprove/{id}', 'OrganizationController@unApprove')->name('organizations.unApprove');
		
		//delete gallery photo
		Route::get('citadel/organizations/destroyGallery/{id}', 'OrganizationController@destroyGallery')->name('organizations.destroyGallery');
		
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
Route::get('/', 'ActivityController@showAllActivities')->name('activities.index');
Route::get('/1', 'ActivityController@showSingleActivity')->name('activities.show');
Route::get('/calendar', 'ActivityController@showCalendar')->name('activities.calendar');

//Organization page
Route::get('/organizations', 'OrganizationController@index')->name('organizations.index');
Route::get('/organizations/{id}', 'OrganizationController@show')->name('organizations.show');


// Route::resource('news', 'NewsController');
Route::get('news', 'NewsController@showAllNews');
Route::get('/news', 'NewsController@showAllNews');

//for test purposes, will be deleted later
Route::get('/test','TestController@index')->name('test.index');