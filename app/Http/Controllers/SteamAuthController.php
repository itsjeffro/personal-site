<?php

namespace App\Http\Controllers;

use App\Game\Steam\SteamAuth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SteamAuthController
{
    /** @var SteamAuth */
    private $steamAuth;

    /**
     * SteamAuthController construct.
     *
     * @param Client $http
     */
    public function __construct(Client $http)
    {
        $this->steamAuth = new SteamAuth($http);
    }

    /**
     * Send user to steam to login.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login()
    {
        $returnUrl = $this->steamAuth
            ->setReturnUrl('http://local.itsjeffro.com/steam/auth')
            ->steamLoginUrl();

        return redirect($returnUrl);
    }

    /**
     * Authenticate user using Steam data.
     *
     * @param Request $request
     * @return void
     */
    public function authenticate(Request $request)
    {
        $steam = $this->steamAuth->authenticate($request);
    }
}
