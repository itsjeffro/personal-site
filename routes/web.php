<?php

use Illuminate\Support\Facades\Route;

Route::get('/.well-known/jwks.json', 'JwksController@index');

Route::get('/steam/login', 'SteamAuthController@login');

Route::get('/steam/auth', 'SteamAuthController@authenticate');

Route::get('/{view?}', 'HomeController@index')->where('view', '(.*)');
