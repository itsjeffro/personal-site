<?php

use Illuminate\Http\Request;
use Lcobucci\JWT\Parser;
use Laravel\Passport\Token;

/*
|--------------------------------------------------------------------------
| External (public) API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth:api'], 'prefix' => 'v1'], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
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
