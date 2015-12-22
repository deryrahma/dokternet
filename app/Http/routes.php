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
// Article management
Route::resource( 'admin/article-category', 'ArticleCategoryController', ['except' => ['show']] );
Route::get( 'admin/article-category/{id}/delete', array('as' => 'admin.article-category.delete', 'uses' => 'ArticleCategoryController@destroy'));
Route::resource( 'admin/article', 'ArticleController' );
Route::get( 'admin/article/{id}/delete', array('as' => 'admin.article.delete', 'uses' => 'ArticleController@destroy'));

// HOME
Route::get( '/', ['as' => 'home', 'uses' => 'HomeController@index'] );
