<?php

namespace Tests\Unit\Game\Steam;

use App\Game\Steam\EndpointBuilder;
use Tests\TestCase;

class EndpointBuilderTest extends TestCase
{
    public function testGetEndpoint()
    {
        $client = new EndpointBuilder('apiKey');

        $endpoint = $client->getEndpoint('ISteamUser/GetPlayerSummaries/v0002', ['steamids' => 'STEAM_ID']);

        $this->assertEquals('https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002?key=apiKey&steamids=STEAM_ID', $endpoint);
    }
}
