<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class JwksController
{
    /**
     * Return a list of public keys for verifying a signed JWT.
     */
    public function index(): JsonResponse
    {
        $keys = [
            'alg' => 'RSA256',
            'kty' => 'RSA',
            'use' => 'sig',
            'kid' => 'jwt_id_rsa',
            'x5t' => config('jwt.keys.public'),
        ];

        return response()->json([
            'keys' => $keys,
        ]);
    }
}
