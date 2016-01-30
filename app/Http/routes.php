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

//REGISTER PASIEN
Route::get( 'patient/register', ['as' => 'patient.register', 'uses' => 'PatientAuthController@register'] );
Route::post('patient/post-register', ['as' => 'patient.post-register', 'uses' => 'PatientAuthController@post_register']);
Route::get('patient/activate/{code}', ['as' => 'patient.activate', 'uses' => 'PatientAuthController@activate']);

//REGISTER DOKTER
Route::get( 'doctor/register', ['as' => 'doctor.register', 'uses' => 'DoctorAuthController@register'] );
Route::post('doctor/post-register', ['as' => 'doctor.post-register', 'uses' => 'DoctorAuthController@post_register']);
Route::get('doctor/activate/{code}', ['as' => 'doctor.activate', 'uses' => 'DoctorAuthController@activate']);


//LOGIN MANAGEMENT
Route::get('patient/login', function(){
	return redirect()->route('patient.login');
});

Route::get('patient/login', array('as' => 'patient.login', 'uses' => 'PatientController@login'));
Route::post('patient/login', array('as' => 'patient.login.post', 'uses' => 'PatientController@postLogin'));
Route::get('patient/logout', array('as' => 'patient.logout', 'uses' => 'PatientController@logout'));

// ADMINISTRATOR MANAGEMENT
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

// Doctor management
/*Route::get('admin/doctor-verify/{id}/delete', array('as' => 'admin.doctor-verify.delete', 'uses' => 'DoctorVerifyController@destroy'));
Route::resource('admin/doctor-verify', 'DoctorVerifyController');

Route::get('admin/doctor-list/{id}/delete', array('as' => 'admin.doctor-list.delete', 'uses' => 'DoctorListController@destroy'));
Route::resource('admin/doctor-list', 'DoctorListController');*/

