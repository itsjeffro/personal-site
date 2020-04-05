<?php

namespace App\Console\Commands;

use App\Player;
use InvalidArgumentException;
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
     * Create a new command instance.
     *
     * @param LoggerInterface $log
     * @return void
     */
    public function __construct(LoggerInterface $log)
    {
        parent::__construct();

        $this->log = $log;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Player $player)
    {
        $players = $player->whereNotNull('steam_id_64')
            ->where('steam_id_64', '!=', 0)
            ->get();

        if (count($players) < 1) {
            $this->info(sprintf('[%s] There were no players with a Steam ID 64', $this->signature));

            return;
        }

        foreach ($players as $player) {
            $this->info(sprintf('[%s] Fetching player summary for Steam ID [%d]', $this->signature, $player->steam_id_64));
        }

        $this->info(sprintf('[%s] Finished', $this->signature));
    }
}