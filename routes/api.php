<?php

Route::post('login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('user', 'Api\AuthController@user');
});

/*
|--------------------------------------------------------------------------
| External (public) API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'v1'], function () {
    // Players
    Route::get('/players', 'Api\PlayerController@index');
    Route::get('/players/{player}', 'Api\PlayerController@show');
});

/*
|--------------------------------------------------------------------------
| Internal API Routes
|-----------------------------------------------------------~---------------
*/

Route::group(['middleware' => 'auth.jwt', 'prefix' => 'internal'], function () {
    // Admins
    Route::get('/admins', 'Api\AdminController@index');
    Route::get('/admins/{auth}', 'Api\AdminController@show');
    Route::put('/admins/{auth}', 'Api\AdminController@update');

    // Admin permissions
    Route::get('/admin-permissions', 'Api\AdminPermissionController@index');
});
