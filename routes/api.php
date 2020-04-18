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

Route::group(['prefix' => 'v1', 'namespace' => 'Api\External'], function () {
    // Players
    Route::get('/players', 'PlayerController@index');
    Route::get('/players/{player}', 'PlayerController@show');

    // Player stats
    Route::get('/player-stats', 'PlayerStatsController@index');

    // Forum topics
    Route::get('/topics', 'TopicController@index');
    Route::get('/topics/{topic}', 'TopicController@show');

    Route::group(['middleware' => 'auth.jwt'], function () {
        // Forum topics
        Route::post('/topics', 'TopicController@store');
        Route::put('/topics/{topic}', 'TopicController@update');

        // Forum topic replies
        Route::post('/topics/{topic}/replies', 'TopicReplyController@store');
    });
});

/*
|--------------------------------------------------------------------------
| Internal API Routes
|-----------------------------------------------------------~---------------
*/

Route::group(['middleware' => 'auth.jwt', 'prefix' => 'internal', 'namespace' => 'Api\Internal'], function () {
    // Admins
    Route::get('/admins', 'AdminController@index');
    Route::get('/admins/{auth}', 'AdminController@show');
    Route::put('/admins/{auth}', 'AdminController@update');

    // Admin permissions
    Route::get('/admin-permissions', 'AdminPermissionController@index');

    // Users
    Route::get('/users', 'UserController@index');
    Route::get('/users/{user}', 'UserController@show');

    // Players
    Route::get('/players', 'PlayerController@index');
    Route::get('/players/{player}', 'PlayerController@show');
});
