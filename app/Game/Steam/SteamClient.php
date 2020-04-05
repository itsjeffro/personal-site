<?php

namespace App\Game\Steam;

use GuzzleHttp\Client;

class SteamClient
{
    /** @var Client */
    private $http;

    /** @var EndpointBuilder */
    private $endpointBuilder;

    /**
     * @param Client $http
     * @param EndpointBuilder $endpointBuilder
     * @return void
     */
    public function __construct(Client $http, EndpointBuilder $endpointBuilder)
    {
        $this->http = $http;
        $this->endpointBuilder = $endpointBuilder;
    }

    /**
     * @param array $players
     * @return array
     */
    public function fetchPlayerSummary(array $players)
    {
        $response = $this->http->request('GET', $this->endpointBuilder->getPlayerSummaryEndpoint($players));

        return json_decode($response->getBody());
    }
}
