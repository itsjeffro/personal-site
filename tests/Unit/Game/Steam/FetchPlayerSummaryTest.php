<?php

namespace Tests\Unit\Game\Steam;

use App\Game\Steam\FetchPlayerSummary;
use App\Game\Steam\SteamClient;
use App\Player;
use PHPUnit\Framework\TestCase;
use \Mockery;

class FetchPlayerSummaryTest extends TestCase
{
    private $player;

    protected function setUp(): void
    {
        $this->player = new Player();
    }

    public function testCorrectNumberOfBatchesReturned()
    {
        $steamClient = Mockery::mock(SteamClient::class);
        $steamClient->shouldReceive('fetchPlayerSummary')->andReturn([]);

        $fetchPlayerSummary = new FetchPlayerSummary($this->player, $steamClient);
        $fetchPlayerSummary->setBatchSize(2);

        $players = [
            ['steam_id_64' => 'STEAM_ID_LAN'],
            ['steam_id_64' => 'STEAM_ID_LAN'],
            ['steam_id_64' => 'STEAM_ID_LAN'],
            ['steam_id_64' => 'STEAM_ID_LAN'],
            ['steam_id_64' => 'STEAM_ID_LAN'],
        ];

        $batches = $fetchPlayerSummary->preparePlayerBatches($players);

        $this->assertEquals(3, count($batches));
    }

    public function testBatchSizeIsReturned()
    {
        $steamClient = Mockery::mock(SteamClient::class);
        $steamClient->shouldReceive('fetchPlayerSummary')->andReturn([]);

        $fetchPlayerSummary = new FetchPlayerSummary($this->player, $steamClient);
        $fetchPlayerSummary->setBatchSize(20);
        
        $this->assertEquals(20, $fetchPlayerSummary->getBatchSize());
    }
}
