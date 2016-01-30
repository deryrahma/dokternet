<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// HOME
Route::get( '/', ['as' => 'home', 'uses' => 'HomeController@index'] );

//REGISTER
Route::get( 'patient/register', ['as' => 'patient.register', 'uses' => 'PatientController@register'] );
Route::post('patient/post-register', ['as' => 'patient.post-register', 'uses' => 'PatientController@post_register']);
Route::get('patient/activate/{code}', ['as' => 'patient.activate', 'uses' => 'PatientController@activate']);


Route::post('search', ['as' => 'search.doctor' , 'uses' => 'HomeController@search']);

//LOGIN MANAGEMENT
Route::get('patient/login', function(){
	return redirect()->route('patient.login');
});
Route::get('patient/login', array('as' => 'patient.login', 'uses' => 'PatientController@login'));
Route::post('patient/login', array('as' => 'patient.login.post', 'uses' => 'PatientController@postLogin'));

Route::group(['middleware' => 'patient'], function()
{
	Route::get('patient/dashboard', array('as' => 'patient.dashboard', 'uses' => 'PatientController@dashboard'));
	Route::get('patient/logout', array('as' => 'patient.logout', 'uses' => 'PatientController@logout'));
	Route::put('patient/update', array('as' => 'patient.update', 'uses' => 'PatientController@update'));
	Route::get('patient/change-password',array('as' => 'patient.change-password', 'uses' => 'PatientController@changePassword'));
	Route::get('patient/history',array('as' => 'patient.history', 'uses' => 'PatientController@history'));
});


Route::get('admin/login', array('as' => 'admin.login', 'uses' => 'AdminController@login'));
Route::post('admin/login', array('as' => 'admin.login.post', 'uses' => 'AdminController@postlogin'));

Route::group(['middleware' => 'admin'], function()
{
	// ADMINISTRATOR MANAGEMENT
	Route::get('admin/logout', array('as' => 'admin.logout', 'uses' => 'AdminController@logout'));

	// Main dashboard
	Route::get( 'admin/dashboard', [ 'as' => 'admin.dashboard', 'uses' => 'AdminController@index' ] );
	// Admin previlege management
	Route::resource( 'admin/previlege', 'AdminPrevilegeController' );
	// Article management
	Route::resource( 'admin/article-category', 'ArticleCategoryController', ['except' => ['show']] );
	Route::get( 'admin/article-category/{id}/delete', array('as' => 'admin.article-category.delete', 'uses' => 'ArticleCategoryController@destroy'));
	Route::resource( 'admin/article', 'ArticleController' );
	Route::get( 'admin/article/{id}/delete', array('as' => 'admin.article.delete', 'uses' => 'ArticleController@destroy'));
	// Patient management
	Route::get('admin/patient/{id}/delete', array('as' => 'admin.patient.delete', 'uses' => 'PatientAdminController@destroy'));
	Route::resource('admin/patient', 'PatientAdminController');
});


// Doctor management
/*Route::get('admin/doctor-verify/{id}/delete', array('as' => 'admin.doctor-verify.delete', 'uses' => 'DoctorVerifyController@destroy'));
Route::resource('admin/doctor-verify', 'DoctorVerifyController');

Route::get('admin/doctor-list/{id}/delete', array('as' => 'admin.doctor-list.delete', 'uses' => 'DoctorListController@destroy'));
Route::resource('admin/doctor-list', 'DoctorListController');*/

