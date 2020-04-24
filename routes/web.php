<?php

use Illuminate\Support\Facades\Route;

Route::get('/.well-known/jwks.json', 'JwksController@index');

Route::get('/{view?}', 'HomeController@index')->where('view', '(.*)');
