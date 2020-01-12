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
		Route::resource('/citadel/organizations', 'OrganizationController')->except('destroy');
		Route::get('citadel/organizations', 'OrganizationController@adminOrg')->name('organizations.adminOrg');


		//users management
		Route::resource('/citadel/profile', 'ProfileController');

		//dispatch approve method in Users Controller
		Route::get('citadel/users/approve/{id}', 'UsersController@approve')->name('users.approve');

		//dispatch unApprove method in Users Controller
		Route::get('citadel/users/unApprove/{id}', 'UsersController@unApprove')->name('users.unApprove');

		//dispatch kickUserFromOrganization method in Users Controller
		Route::get('citadel/users/kickUserFromOrganization/{id}/{organization_id}', 'UsersController@kickUserFromOrganization')->name('users.kickUserFromOrganization');

		//delete organizations
		Route::delete('citadel/organizations/destroy/{id}', 'OrganizationController@destroy')->name('organizations.destroy');

		//dispatch approve method in Organizations Controller
		Route::get('citadel/organizations/approve/{id}', 'OrganizationController@approve')->name('organizations.approve');

		//dispatch unApprove method in Organizations Controller
		Route::get('citadel/organizations/unAapprove/{id}', 'OrganizationController@unApprove')->name('organizations.unApprove');

		//delete gallery photo
		Route::delete('citadel/activities/destroyGallery/{id}', 'ActivityController@destroyGallery')->name('activities.destroyGallery');
		Route::delete('citadel/organizations/destroyGallery/{id}', 'OrganizationController@destroyGallery')->name('organizations.destroyGallery');

		//activities management
		Route::get   ('/citadel/activity','ActivityController@manage')->name('activities.manage');
		Route::get   ('/citadel/activity/create','ActivityController@create')->name('activities.create');
		Route::post  ('/citadel/activity/store', 'ActivityController@store')->name('activities.store');
		Route::get   ('/citadel/activity/{id}/edit', 'ActivityController@edit')->name('activities.edit');
		Route::put   ('/citadel/activity/{id}', 'ActivityController@update')->name('activities.update');
		Route::delete('/citadel/activity/{id}', 'ActivityController@destroy')->name('activities.destroy');
		Route::get('/citadel/activity/approve/{id}', 'ActivityController@approve')->name('activities.approve');
		Route::get('/citadel/activity/unAapprove/{id}', 'ActivityController@unApprove')->name('activities.unApprove');
		Route::get('/get/subcategories/{category}/{subcategory?}', 'ActivityController@getSucategories')->name('get.subcategories');
		Route::put   ('/citadel/activity/{id}/saveOrder', 'ActivityController@saveOrder')->name('activities.saveOrder');

		// category management
		Route::resource('/citadel/category', 'CategoryController');

		//subcategory management
		Route::resource('/citadel/subcategory', 'SubCategoryController');
		Route::get('/citadel/subcategory/{categoryId}/createsubcategory','SubCategoryController@addSubcategoryCategory')->name('subcategorycategory.create');
		Route::get('/citadel/subcategory/{categoryId}/review','SubCategoryController@review')->name('subcategory.review');

		// groups management
		Route::resource('/citadel/group', 'GroupController');
		Route::get('/citadel/group/{groupId}/creategroup','GroupController@addGroupActivity')->name('groupactivity.create');
		Route::get('/citadel/group/{activityId}/review','GroupController@review')->name('group.review');

		//shedules management
		Route::resource('/citadel/schedule', 'ScheduleController');
		Route::get('/citadel/schedule/{groupId}/createschedule','ScheduleController@addScheduleGroup')->name('schedulegroup.create');
		Route::get('/citadel/schedule/{groupId}/review','ScheduleController@review')->name('schedule.review');

		//news management
		Route::resource('/citadel/news', 'NewsController');
		Route::get('citadel/news', 'NewsController@adminNews')->name('news.adminNews');
		Route::get('/citadel/news/approve/{id}', 'NewsController@approve')->name('news.approve');
		Route::get('/citadel/news/unAapprove/{id}', 'NewsController@unApprove')->name('news.unApprove');
		Route::get('/get/news/{organziation}/{activity?}', 'NewsController@getActivities')->name('get.activities');
		Route::resource('/citadel/subscription', 'SubscriptionController');
	});

});

Auth::routes();

// Activities pages
Route::get('/','ActivityController@index')->name('activities.index');
Route::get('/activity/{id}', 'ActivityController@show')->name('activities.show');
Route::post ('/activity/subscribe','ActivityController@subscribe')->name('activities.subscribe');

//Organization page
Route::get('/organizations', 'OrganizationController@index')->name('organizations.index');
Route::get('/organizations/{id}', 'OrganizationController@show')->name('organizations.show');
Route::post ('/organizations/subscribe','OrganizationController@subscribe')->name('organizations.subscribe');

// Route::resource('news', 'NewsController');
Route::get('/news', 'NewsController@index')->name('news.index');
Route::get('/news/{id}', 'NewsController@show')->name('news.show');

//for test purposes, will be deleted later
Route::get('/test','TestController@index')->name('test.index');

//subscribtions management
Route::post  ('/activity/store', 'SubscriptionController@store')->name('subscription.store');

//Team pages
Route::get('/team','TeamController@index')->name('team.index');
