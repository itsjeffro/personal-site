<?php

namespace App\Console\Commands;

use App\Game\Steam\EndpointBuilder;
use App\Game\Steam\FetchPlayerSummary;
use App\Game\Steam\SteamClient;
use App\Player;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
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
        $apiKey = config('services.steam.api_web_key');
        
        $steamClient = new SteamClient(new Client(), new EndpointBuilder($apiKey));

        $fetchPlayerSummary = new FetchPlayerSummary($this->player, $steamClient);

        $fetchPlayerSummary
            ->setBatchSize(50)
            ->execute();

        $this->info(sprintf('[%s] Finished', $this->signature));
    }
}
