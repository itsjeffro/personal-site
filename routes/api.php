<?php

use Illuminate\Http\Request;
use Lcobucci\JWT\Parser;
use Laravel\Passport\Token;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| External (public) API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'v1'], function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

    Route::get('/players', 'Api\PlayerController@index');
    Route::get('/players/{player}', 'Api\PlayerController@show');

    Route::get('/admins', 'Api\AdminController@index');
});

/*
|--------------------------------------------------------------------------
| Internal API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('client')->group(function () {
    Route::get('/scopes', function (Request $request) {
        $bearerToken = $request->bearerToken();
        $tokenId = (new Parser())->parse($bearerToken)->getHeader('jti');
        $client = Token::find($tokenId);

        return $client->scopes;
    });
});
