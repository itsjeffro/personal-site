<?php

namespace App\Console\Commands;

use App\Game\Steam\EndpointBuilder;
use App\Game\Steam\SteamClient;
use App\Player;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use SteamID;
use Psr\Log\LoggerInterface;

class SteamFetchPlayerSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'steam:fetch-player';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch player summary using the Steam Web API';

    /**
     * @var LoggerInterface
     */
    private $log;

    /**
     * @var Player
     */
    private $player;

    /**
     * Create a new command instance.
     *
     * @param LoggerInterface $log
     * @param Player $player
     * @return void
     */
    public function __construct(LoggerInterface $log, Player $player)
    {
        parent::__construct();

        $this->log = $log;
        $this->player = $player;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $players = $this->player
            ->whereNotNull('steam_id_64')
            ->where('steam_id_64', '!=', 0)
            ->get();

        if (count($players) < 1) {
            $this->info(sprintf('[%s] There were no players with a Steam ID 64', $this->signature));
            return;
        }

        $playerSummaries = $this->fetchPlayerSummaries($players);

        foreach ($playerSummaries as $playerSummary) {
            $player = $this->player
                ->where('steam_id_64', $playerSummary->steamid)
                ->first();

            if (!$player instanceof Player) {
                $this->info(sprintf('[%s] Steam ID 64 [%s] does not exist', $this->signature, $playerSummary->steamid));
                continue;
            }

            $player->avatar = $playerSummary->avatar;
            $player->save();

            $this->info(sprintf('[%s] Player ID [%s] with Steam ID 64 [%s] was updated', $this->signature, $player->id, $playerSummary->steamid));
        }

        $this->info(sprintf('[%s] Finished', $this->signature));
    }

    /**
     * Loop through API response container steam players.
     * Store the players so we can easily loop through
     * them all later or and update their details.
     *
     * @param array $players
     * @return array
     */
    public function fetchPlayerSummaries($players): array
    {
        $apiKey = config('services.steam.api_web_key');
        
        $steamClient = new SteamClient(new Client(), new EndpointBuilder($apiKey));

        $playerSummaries = [];

        foreach ($players as $player) {
            $this->info(sprintf('[%s] Fetching player summary for Steam ID [%s]', $this->signature, $player->steam_id_64));

            // @TODO Perform this in a queue.
            $playerSummaryResponse = $steamClient->fetchPlayerSummary([$player->steam_id_64]);

            foreach ($playerSummaryResponse->response->players as $playerSummary) {
                $playerSummaries[] = $playerSummary;
            }
        }

        return $playerSummaries;
    }
}
