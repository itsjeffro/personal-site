<?php

namespace App\Game\Steam;

use App\Player;
use App\Game\Steam\SteamClient;

class FetchPlayerSummary
{
    /** @var Player */
    private $player;

    /** @var int */
    private $batchSize = 50;

    /** @var SteamClient */
    private $steamClient;

    /**
     * FetchPlayerSummary constructor.
     *
     * @param Player $player
     * @param SteamClient $steamClient
     */
    public function __construct(Player $player, SteamClient $steamClient)
    {
        $this->player = $player;
        $this->steamClient = $steamClient;
    }

    /**
     * Execute fetch player summary and update.
     *
     * @return void
     */
    public function execute()
    {
        $players = $this->player
            ->select('steam_id_64')
            ->whereNotNull('steam_id_64')
            ->where('steam_id_64', '!=', 0)
            ->get()
            ->toArray();
            
        $playerBatches = $this->preparePlayerBatches($players);
        
        $playerSummaries = $this->fetchPlayerSummaries($playerBatches);

        $this->updatePlayers($playerSummaries);
    }

    /**
     * Prepare player batches.
     *
     * @param Player[] $players
     * @return array[]
     */
    public function preparePlayerBatches(array $players): array
    {
        $batches = [];

        // Set pointers for the number of batches and
        // the number of items in a single batch.
        $batchCount = 1;
        $bacthedItemCount = 0;

        foreach ($players as $player) {
            $bacthedItemCount++;

            $batches[$batchCount][] = $player['steam_id_64'] ?? '';

            // Once we've reached the target number of items for a batch, we'll increment the 
            // the batch count and reset the counter for the number of currently in a batch.
            if ($bacthedItemCount === $this->getBatchSize()) {
                $bacthedItemCount = 0;
                $batchCount++;
            }
        }

        return $batches;
    }

    /**
     * Loop through API response container steam players. Store the players so 
     * we can easily loop through them all later or and update their details.
     *
     * @param array $players
     * @return object[]
     */
    public function fetchPlayerSummaries($playerBatches): array
    {
        $playerSummaries = [];

        foreach ($playerBatches as $playerBatch) {
            $playerSummaryResponse = $this->steamClient->fetchPlayerSummary($playerBatch);

            foreach ($playerSummaryResponse->response->players as $playerSummary) {
                $playerSummaries[] = $playerSummary;
            }
        }

        return $playerSummaries;
    }

    /**
     * Updated players using the fetch player summaries from the Steam API.
     *
     * @param array $playerSummaries
     * @return void
     */
    public function updatePlayers(array $playerSummaries)
    {
        foreach ($playerSummaries as $playerSummary) {
            $player = $this->player
                ->where('steam_id_64', $playerSummary->steamid)
                ->first();

            if (!$player instanceof Player) {
                continue;
            }

            $player->avatar = $playerSummary->avatar;
            $player->save();
        }
    }
    
    /**
     * Get the number of items to be included in a single batch.
     *
     * @return integer
     */
    public function getBatchSize(): int
    {
        return $this->batchSize;
    }

    /**
     * Set the number of items contained in a single batch.
     *
     * @param integer $batchSize
     * @return self
     */
    public function setBatchSize(int $batchSize): self
    {
        $this->batchSize = $batchSize;

        return $this;
    }
}
