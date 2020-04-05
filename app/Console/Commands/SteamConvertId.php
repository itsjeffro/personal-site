<?php

namespace App\Console\Commands;

use App\Player;
use InvalidArgumentException;
use Illuminate\Console\Command;
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
        $players = $player->whereNull('steam_id_64')->get();

        if (count($players) < 1) {
            $this->info(sprintf('[%s] There were no players that required updating.', $this->signature));

            return;
        }

        foreach ($players as $player) {
            $steamId64 = 0;

            try {
                $steam = new SteamID($player->steam_id);
                $steamId64 = $steam->ConvertToUInt64();
            } catch (InvalidArgumentException $e) {
                $message = sprintf('Player ID [%d] could not convert Steam ID [%s]', $player->id, $player->steam_id);

                $this->info($message);

                $this->log->info($message, [
                    'message' => $e->getMessage(),
                ]);
            } finally {
                $player->steam_id_64 = $steamId64;
                $player->save();

                $this->info(sprintf('Player ID [%d] created Steam ID 64 [%s] from Steam ID [%s]', $player->id, $steamId64, $player->steam_id));
            }
        }

        $this->info(sprintf('[%s] Finished', $this->signature));
    }
}
