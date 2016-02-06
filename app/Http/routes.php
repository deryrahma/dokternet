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
/*Route::get( 'patient/register', ['as' => 'patient.register', 'uses' => 'PatientAuthController@register'] );
Route::post('patient/post-register', ['as' => 'patient.post-register', 'uses' => 'PatientAuthController@post_register']);
Route::get('patient/activate/{code}', ['as' => 'patient.activate', 'uses' => 'PatientAuthController@activate']);*/

//REGISTER DOKTER
/*Route::get( 'doctor/register', ['as' => 'doctor.register', 'uses' => 'DoctorAuthController@register'] );
Route::post('doctor/post-register', ['as' => 'doctor.post-register', 'uses' => 'DoctorAuthController@post_register']);
Route::get('doctor/activate/{code}', ['as' => 'doctor.activate', 'uses' => 'DoctorAuthController@activate']);*/

//REGISTER
Route::get( 'patient/register', ['as' => 'patient.register', 'uses' => 'PatientController@register'] );
Route::post('patient/post-register', ['as' => 'patient.post-register', 'uses' => 'PatientController@post_register']);
Route::get('patient/activate/{code}', ['as' => 'patient.activate', 'uses' => 'PatientController@activate']);


Route::get('search', ['as' => 'search.doctor' , 'uses' => 'HomeController@search']);
Route::get('doctor/{name}', ['as' => 'doctor.search-profile' , 'uses' => 'HomeController@searchProfile']);
Route::get('article/{category}', ['as' => 'home.article.show', 'uses' => 'HomeController@article']);

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
	Route::get( 'admin', [ 'as' => 'admin.dashboard', 'uses' => 'AdminController@index' ] );
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
	// Clinic management
	Route::get('admin/clinic/{id}/delete', array('as' => 'admin.clinic.delete', 'uses' => 'ClinicAdminController@destroy'));
	Route::resource('admin/clinic', 'ClinicAdminController');
	// Doctor management
	Route::get('admin/doctor/{id}/delete', array('as' => 'admin.doctor.delete', 'uses' => 'DoctorAdminController@destroy'));
	Route::resource('admin/doctor', 'DoctorAdminController');
});

Route::get( 'clinic/login', array( 'as' => 'clinic.login', 'uses' => 'ClinicController@login' ) );
Route::post( 'clinic/login', array( 'as' => 'clinic.login.post', 'uses' => 'ClinicController@postLogin' ) );
Route::group( ['middleware' => 'clinic'], function() {
	Route::get( 'clinic/dashboard', array( 'as' => 'clinic.dashboard', 'uses' => 'ClinicController@dashboard' ) );
	Route::put( 'clinic/update', array( 'as' => 'clinic.update', 'uses' => 'ClinicController@update' ) );
	Route::get( 'clinic/change-password', array( 'as' => 'clinic.change-password', 'uses' => 'ClinicController@changePassword' ) );
	Route::get( 'clinic/doctor', array( 'as' => 'clinic.doctor', 'uses' => 'ClinicController@doctor' ) );
	Route::get( 'clinic/appointment', array( 'as' => 'clinic.appointment', 'uses' => 'ClinicController@appointment' ) );
	Route::get( 'clinic/report', array( 'as' => 'clinic.report', 'uses' => 'ClinicController@report' ) );
} );

// RESERVATION
Route::get( 'reservation/{id}', array( 'as' => 'reservation.schedule', 'uses' => 'ReservationController@schedule' ) );
Route::get( 'reservation/{id}/book', array( 'as' => 'reservation.book', 'uses' => 'ReservationController@book' ) );
Route::post( 'reservation/{id}/book/login', array( 'as' => 'reservation.login', 'uses' => 'ReservationController@login' ) );
Route::post( 'reservation/{id}/book/confirm', array( 'as' => 'reservation.confirm', 'uses' => 'ReservationController@confirm' ) );
Route::post( 'reservation/{id}/book/verify', array( 'as' => 'reservation.verify', 'uses' => 'ReservationController@verify' ) );

// Doctor management
/*Route::get('admin/doctor-verify/{id}/delete', array('as' => 'admin.doctor-verify.delete', 'uses' => 'DoctorVerifyController@destroy'));
Route::resource('admin/doctor-verify', 'DoctorVerifyController');

Route::get('admin/doctor-list/{id}/delete', array('as' => 'admin.doctor-list.delete', 'uses' => 'DoctorListController@destroy'));
Route::resource('admin/doctor-list', 'DoctorListController');*/

