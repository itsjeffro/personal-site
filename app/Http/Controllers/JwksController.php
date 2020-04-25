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
        $fileContents = file_get_contents(config('jwt.keys.public'));
        $fileContents = str_replace('-----BEGIN CERTIFICATE-----', '', $fileContents);
        $fileContents = str_replace('-----END CERTIFICATE-----', '', $fileContents);

        $key = [
            'alg' => 'RSA256',
            'kty' => 'RSA',
            'use' => 'sig',
            'kid' => 'jwt_id_rsa',
            'x5c' => [
                preg_replace("/\r|\n/", '', $fileContents)
            ],
        ];

        return response()->json([
            'keys' => [
                $key
            ]
        ]);
    }
}
