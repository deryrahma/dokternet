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

// ADMINISTRATOR MANAGEMENT
// Main dashboard
Route::get( 'admin/dashboard', [ 'as' => 'admin.dashboard', 'uses' => 'AdminController@index' ] );
// Admin previlege management
Route::resource( 'admin/previlege', 'AdminPrevilegeController' );
