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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/settings/profile', 'SettingsProfileController@show')->name('settings.profile.show');

Route::get('/applications/create', 'OauthController@create')->name('oauth.create');
Route::post('/applications', 'OauthController@store')->name('oauth.store');
Route::get('/applications/{oauth_client}', 'OauthController@show')->name('oauth.show');
Route::put('/applications/{oauth_client}', 'OauthController@update')->name('oauth.update');