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

// Include Admin Route
include('admin.php');

Route::get('/404', function () {
    return view('404');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/','FrontendController@index');
Route::get('contact_us','FrontendController@contact_us');
Route::get('school/{id}/{name?}','FrontendController@show_school');
Route::get('school_search','FrontendController@school_search');
Route::get('add_school','FrontendController@add_school');
Route::get('ContactUs','FrontendController@contact');
Route::post('store_school','FrontendController@store_school');

Route::get('/lang/{lang?}','SettingsController@ChangeLanguage');
