<?php

namespace Tests\Unit\Game\Steam;

use App\Game\Steam\FetchPlayerSummary;
use App\Game\Steam\SteamClient;
use App\Player;
use PHPUnit\Framework\TestCase;
use \Mockery;

class FetchPlayerSummaryTest extends TestCase
{
    public function testBatchSizeIsReturned()
    {
        $player = new Player();
        $steamClient = Mockery::mock(SteamClient::class);
        $steamClient->shouldReceive('fetchPlayerSummary')->andReturn([]);

        $fetchPlayerSummary = new FetchPlayerSummary($player, $steamClient);
        $fetchPlayerSummary->setBatchSize(20);
        
        $this->assertEquals(20, $fetchPlayerSummary->getBatchSize());
    }
}
