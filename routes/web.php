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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/application/oauth/create', 'OauthController@create')->name('oauth.create');
Route::post('/application/oauth', 'OauthController@store')->name('oauth.store');
Route::get('/application/oauth/{oauth_client}', 'OauthController@show')->name('oauth.show');
Route::put('/application/oauth/{oauth_client}', 'OauthController@update')->name('oauth.update');