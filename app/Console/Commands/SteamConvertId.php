<?php

namespace App\Console\Commands;

use App\Player;
use App\PlayerStats;
use DateTime;
use InvalidArgumentException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SteamID;
use Psr\Log\LoggerInterface;

class SteamConvertId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'steam:convert-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Detects the currently stored Steam ID and converts it to Steam ID 64';

    /** @var LoggerInterface */
    private $log;

    /** @var Player */
    private $player;

    /** @var PlayerStats */
    private $playerStats;

    /**
     * Create a new command instance.
     *
     * @param LoggerInterface $log
     * @param Player $player
     * @param PlayerStats $playerStats
     * @return void
     */
    public function __construct(LoggerInterface $log, Player $player, PlayerStats $playerStats)
    {
        parent::__construct();

        $this->log = $log;
        $this->player = $player;
        $this->playerStats = $playerStats;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $playerStats = $this->playerStats
            ->select('player_stats.steam_id')
            ->leftJoin('players', 'players.steam_id', '=', 'player_stats.steam_id')
            ->where('player_stats.steam_id', '!=', '')
            ->whereNull('players.steam_id')
            ->get();

        if (count($playerStats) < 1) {
            $this->info(sprintf('[%s] There were no players that required updating.', $this->signature));

            return;
        }

        $players = [];

        foreach ($playerStats as $stats) {
            $steamId64 = 0;

            try {
                $steam = new SteamID($stats->steam_id);

                $steamId64 = $steam->ConvertToUInt64();
            } catch (InvalidArgumentException $e) {
                $message = sprintf('Player stats ID [%d] could not convert Steam ID [%s]', $stats->id, $stats->steam_id);

                $this->info($message);

                $this->log->info($message, [
                    'message' => $e->getMessage(),
                ]);
            } finally {
                $players[] = [
                    'steam_id' => $stats->steam_id,
                    'steam_id_64' => $steamId64,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ];
            }
        }

        if (count($players) > 0) {
            Player::insert($players);
        }

        $this->info(sprintf('[%s] Finished', $this->signature));
    }
}
