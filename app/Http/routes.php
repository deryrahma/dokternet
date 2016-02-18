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
Route::get('category/{category}', ['as' => 'home.category.show', 'uses' => 'HomeController@category']);
Route::get('article/{category}', ['as' => 'home.article.show', 'uses' => 'HomeController@article']);
Route::get('blog', ['as' => 'home.blog', 'uses' => 'HomeController@blog']);

//LOGIN MANAGEMENT
Route::get('patient/login', function(){
	return redirect()->route('patient.login');
});

Route::get('auth/login', array('as' => 'patient.login', 'uses' => 'PatientController@login'));
Route::post('patient/login', array('as' => 'patient.login.post', 'uses' => 'PatientController@postLogin'));

Route::group(['middleware' => 'patient'], function()
{
	Route::get('patient/dashboard', array('as' => 'patient.dashboard', 'uses' => 'PatientController@dashboard'));
	Route::get('patient/logout', array('as' => 'patient.logout', 'uses' => 'PatientController@logout'));
	Route::put('patient/update', array('as' => 'patient.update', 'uses' => 'PatientController@update'));
	Route::get('patient/change-password',array('as' => 'patient.change-password', 'uses' => 'PatientController@changePassword'));
	Route::post('patient/change-password', array('as' => 'patient.change-password.store', 'uses' => 'PatientController@submitChangePassword'));
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
	// Specialization management
	Route::get('admin/spec/{id}/delete', array('as' => 'admin.spec.delete', 'uses' => 'SpecAdminController@destroy'));
	Route::resource('admin/spec', 'SpecAdminController');
	// Specialization category management
	Route::get('admin/spec-cat/{id}/delete', array('as' => 'admin.spec-cat.delete', 'uses' => 'SpecCatAdminController@destroy'));
	Route::resource('admin/spec-cat', 'SpecCatAdminController');

	// Add Doctor from Clinic management
	//Route::get('admin/clinic/doctor/{id}/delete', array('as' => 'admin.clinic.doctor.delete', 'uses' => 'DoctorAtClinicAdminController@destroy'));
	//Route::resource('admin/clinic/doctor', 'DoctorAtClinicAdminController');

	// Doctor management
	Route::get('admin/doctor/{id}/delete', array('as' => 'admin.doctor.delete', 'uses' => 'DoctorAdminController@destroy'));
	Route::resource('admin/doctor', 'DoctorAdminController');
	Route::get('admin/doctor/education/{id}/destroy',array('as' => 'admin.doctor.education.destroy', 'uses' => 'DoctorAdminController@educationDestroy'));
	Route::get('admin/doctor/{id}/education',array('as' => 'admin.doctor.education.create', 'uses' => 'DoctorAdminController@education'));
	Route::post('admin/doctor/{id}/education',array('as' => 'admin.doctor.education.store', 'uses' => 'DoctorAdminController@educationStore'));
	Route::get('admin/doctor/experience/{id}/destroy',array('as' => 'admin.doctor.experience.destroy', 'uses' => 'DoctorAdminController@experienceDestroy'));
	Route::get('admin/doctor/{id}/experience',array('as' => 'admin.doctor.experience.create', 'uses' => 'DoctorAdminController@experience'));
	Route::post('admin/doctor/{id}/experience',array('as' => 'admin.doctor.experience.store', 'uses' => 'DoctorAdminController@experienceStore'));
});

Route::get( 'clinic/register', ['as' => 'clinic.register', 'uses' => 'ClinicController@register'] );
Route::post('clinic/post-register', ['as' => 'clinic.post-register', 'uses' => 'ClinicController@post_register']);
Route::get( 'clinic/login', array( 'as' => 'clinic.login', 'uses' => 'ClinicController@login' ) );
Route::post( 'clinic/login', array( 'as' => 'clinic.login.post', 'uses' => 'ClinicController@postLogin' ) );
Route::group( ['middleware' => 'clinic'], function() {
	Route::get( 'clinic/dashboard', array( 'as' => 'clinic.dashboard', 'uses' => 'ClinicController@dashboard' ) );
	Route::put( 'clinic/update', array( 'as' => 'clinic.update', 'uses' => 'ClinicController@update' ) );
	Route::get( 'clinic/change-password', array( 'as' => 'clinic.change-password', 'uses' => 'ClinicController@changePassword' ) );
	Route::post( 'clinic/change-password', array( 'as' => 'clinic.change-password.save', 'uses' => 'ClinicController@postChangePassword' ) );
	Route::resource( 'clinic/doctor', 'DoctorClinicController');
	Route::resource( 'clinic/schedule', 'ScheduleController', ['except' => ['show']] );
	Route::get( 'clinic/schedule/cancel/{id}', array( 'as' => 'clinic.schedule.cancel', 'uses' => 'ScheduleController@cancel' ) );
	Route::get( 'clinic/reservation', array( 'as' => 'clinic.reservation', 'uses' => 'ReservationController@index' ) );
	Route::get( 'clinic/reservation/accept/{id}', array( 'as' => 'clinic.reservation.accept', 'uses' => 'ReservationController@accept' ) );
	Route::get( 'clinic/reservation/decline/{id}', array( 'as' => 'clinic.reservation.decline', 'uses' => 'ReservationController@decline' ) );
	Route::get( 'clinic/reservation/done/{id}', array( 'as' => 'clinic.reservation.done', 'uses' => 'ReservationController@done' ) );
	Route::get( 'clinic/reservation/cancel/{id}', array( 'as' => 'clinic.reservation.cancel', 'uses' => 'ReservationController@cancel' ) );
	Route::get( 'clinic/report', array( 'as' => 'clinic.report', 'uses' => 'ClinicController@report' ) );
} );

// RESERVATION
Route::get( 'reservation/{id}', array( 'as' => 'reservation.schedule', 'uses' => 'ReservationController@schedule' ) );
Route::get( 'reservation/{id}/book', array( 'as' => 'reservation.book', 'uses' => 'ReservationController@book' ) );
Route::post( 'reservation/{id}/book/login', array( 'as' => 'reservation.login', 'uses' => 'ReservationController@login' ) );
Route::post( 'reservation/{id}/book/confirm', array( 'as' => 'reservation.confirm', 'uses' => 'ReservationController@confirm' ) );
Route::post( 'reservation/{id}/book/verify', array( 'as' => 'reservation.verify', 'uses' => 'ReservationController@verify' ) );

Route::get('doctor/review/{id}/create', array('as' => 'doctor.review.create', 'uses' => 'PatientController@review'));
Route::post('doctor/review/{id}/create', array('as' => 'doctor.review.store', 'uses' => 'PatientController@reviewStore'));
Route::get('clinic/doctor/{id}/education/create', array('as' => 'clinic.doctor.education.create', 'uses' => 'ClinicController@education'));
Route::post('clinic/doctor/{id}/education/create', array('as' => 'clinic.doctor.education.store', 'uses' => 'ClinicController@educationStore'));
Route::get('clinic/doctor/education/{id}/destroy', array('as' => 'clinic.doctor.education.destroy', 'uses' => 'ClinicController@educationDestroy'));
Route::get('clinic/doctor/{id}/experience/create', array('as' => 'clinic.doctor.experience.create', 'uses' => 'ClinicController@experience'));
Route::post('clinic/doctor/{id}/experience/create', array('as' => 'clinic.doctor.experience.store', 'uses' => 'ClinicController@experienceStore'));
Route::get('clinic/doctor/experience/{id}/destroy', array('as' => 'clinic.doctor.experience.destroy', 'uses' => 'ClinicController@experienceDestroy'));


// Doctor management
/*Route::get('admin/doctor-verify/{id}/delete', array('as' => 'admin.doctor-verify.delete', 'uses' => 'DoctorVerifyController@destroy'));
Route::resource('admin/doctor-verify', 'DoctorVerifyController');

Route::get('admin/doctor-list/{id}/delete', array('as' => 'admin.doctor-list.delete', 'uses' => 'DoctorListController@destroy'));
Route::resource('admin/doctor-list', 'DoctorListController');*/


Route::resource( 'contact-us', 'ContactUsController', ['except' => ['show', 'delete']] );
Route::get( 'admin/contact-us', ['as' => 'admin.contact-us', 'uses' => 'ContactUsController@adminIndex'] );
Route::get( 'admin/contact-us/{id}/show', ['as' => 'admin.contact-us.show', 'uses' => 'ContactUsController@adminShow'] );
Route::get( 'admin/contact-us/{id}/delete', ['as' => 'admin.contact-us.delete', 'uses' => 'ContactUsController@adminDelete'] );

Route::controllers([
	'password' => 'Auth\PasswordController'
]);
Route::get('auth/logout', array('as' => 'auth.logout', 'uses' => 'PatientController@logout'));
