<?php

namespace App\Game\Steam;

class EndpointBuilder
{
    /** @var string */
    const BASE_URL = 'https://api.steampowered.com';

    /** @string */
    private $steamApiKey;

    /**
     * Client constructor
     *
     * @param string $steamApiKey
     */
    public function __construct(string $steamApiKey)
    {
        $this->steamApiKey = $steamApiKey;
    }

    /**
     * @param string $endpoint
     * @param string[] $query
     * @return string
     */
    public function getEndpoint(string $endpoint, array $query): string
    {
        $api = self::BASE_URL . '/' . rtrim(ltrim($endpoint, '/'), '/');

        $baseQuery = [
            'key' => $this->steamApiKey
        ];

        $baseQuery = array_merge($baseQuery, $query);

        return $api . '?' . http_build_query($baseQuery);
    }

    /**
     * @param string[] $players
     * @return string
     */
    public function getPlayerSummaryEndpoint(array $players): string
    {
        $players = implode(',', $players);

        return $this->getEndpoint('ISteamUser/GetPlayerSummaries/v0002', ['steamids' => $players]);
    }
}
