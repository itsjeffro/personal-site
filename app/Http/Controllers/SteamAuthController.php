<?php

namespace App\Http\Controllers;

use App\Game\Steam\EndpointBuilder;
use App\Game\Steam\SteamAuth;
use App\Game\Steam\SteamClient;
use App\Player;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SteamAuthController
{
    /** @var SteamClient */
    private $steamClient;

    /** @var SteamAuth */
    private $steamAuth;

    /** @var User */
    private $user;

    /** @var Player */
    private $player;

    /**
     * SteamAuthController construct.
     *
     * @param Client $http
     */
    public function __construct(Client $http, User $user, Player $player)
    {
        $apiKey = config('services.steam.api_web_key');

        $this->steamClient = new SteamClient($http, new EndpointBuilder($apiKey));
        $this->steamAuth = new SteamAuth($http);
        $this->user = $user;
        $this->player = $player;
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
        $steamClaimId = $this->steamAuth->authenticate($request);

        $segments = explode('/', $steamClaimId);
        $indexCounts = count($segments) - 1;

        $steamId64 = $segments[$indexCounts] ?? null;

        if (!$steamId64) {
            throw new InvalidArgumentException('No valid steam id 64 was provided.');
        }

        $player = $this->player
            ->where('steam_id_64', $steamId64)
            ->first();

        if (!$player instanceof Player) {
            $player = new Player();
            $player->steam_id_64 = $steamId64;
            $player->save();
        }

        $user = $this->user
            ->where('player_id', $player->id)
            ->first();

        if (!$user instanceof User) {
            $playerSummaries = $this->steamClient->fetchPlayerSummary([$steamId64]);

            $playerSummary = $playerSummaries->response->players[0] ?? 'STEAM_PLAYER_'.$steamId64;

            $user = new User();
            $user->player_id = $player->id;
            $user->name = $playerSummary->personaname;
            $user->save();
        }

        return redirect('/');
    }
}
