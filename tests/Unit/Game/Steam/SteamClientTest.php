<?php

namespace Tests\Unit\Game\Steam;

use App\Game\Steam\SteamClient;
use App\Game\Steam\EndpointBuilder;
use GuzzleHttp\Client;
use Tests\TestCase;
use \Mockery;

class SteamClientTest extends TestCase
{
    public function testFetchPlayerSummary()
    {
        $mockData = json_encode([
            'response' => [
                'players' => [
                    [
                        'steam_id' => '00000000000000000'
                    ]
                ]
            ]
        ]);

        // Setup mock response with our mock data. Guzzle will typically return a ResponseInterface.
        $mockResponse = Mockery::mock(\Psr\Http\Message\ResponseInterface::class);
        $mockResponse->shouldReceive('getStatusCode')->andReturn(200);
        $mockResponse->shouldReceive('getBody')->andReturn($mockData);

        // Create a mock of the Guzzle client which returns our mock response from the method request().
        $mockClient = Mockery::mock(Client::class);
        $mockClient->shouldReceive('request')->andReturn($mockResponse);

        // Fetch player summary.
        $steamClient = new SteamClient($mockClient, new EndpointBuilder('apiKey'));
        $response = $steamClient->fetchPlayerSummary(['00000000000000000']);

        $this->assertEquals('00000000000000000', $response->response->players[0]->steam_id);
    }
}
