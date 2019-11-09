<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/settings/profile', 'Backend\SettingsProfileController@show')->name('settings.profile.show');
    Route::get('/settings/account', 'Backend\SettingsAccountController@show')->name('settings.account.show');
    Route::get('/settings/security', 'Backend\SettingsSecurityController@show')->name('settings.security.show');
    Route::put('/settings/security', 'Backend\SettingsSecurityController@update')->name('settings.security.update');

    Route::get('/applications/create', 'Backend\OauthController@create')->name('oauth.create');
    Route::post('/applications', 'Backend\OauthController@store')->name('oauth.store');
    Route::get('/applications/{oauth_client}', 'Backend\OauthController@show')->name('oauth.show');
    Route::put('/applications/{oauth_client}', 'Backend\OauthController@update')->name('oauth.update');
    Route::delete('/applications/{oauth_client}', 'Backend\OauthController@destroy')->name('oauth.delete');
});

Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/users', 'Backend\UsersController@index')->name('users.list');
    Route::get('/roles', 'Backend\RolesController@index')->name('roles.list');
});
