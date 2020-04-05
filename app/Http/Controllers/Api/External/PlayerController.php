<?php

namespace App\Http\Controllers\Api\External;

use App\Player;
use Illuminate\Http\Request;
use App\Http\Resources\Player as PlayerResource;
use App\Game\Sort;

class PlayerController
{
    /** @var Player */
    private $player;

    /**
     * PlayerController
     *
     * @param Player $player
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * List players.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', Player::DEFAULT_PER_PAGE);

        // Sorts
        $sortableColumns = [
            'id' => 'id', 
            'kills' => 'kills',
            'deaths' => 'deaths',
            'name' => 'name',
        ];

        $defaultSort = 'id:asc';
        
        $requestedSort = $request->get('sort', $defaultSort);

        $sort = new Sort($requestedSort, $defaultSort, $sortableColumns);

        $players = $this->player
            ->leftJoin('player_stats', 'player_stats.steam_id', '=', 'players.steam_id')
            ->with('playerStats')
            ->withCount(['admin'])
            ->orderBy($sort->getColumn(), $sort->getOrder())
            ->paginate($perPage);

        return PlayerResource::collection($players);
    }

    /**
     * Show player.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Player $player)
    {
        $player = $player->with(['playerStats', 'admin'])
            ->withCount(['admin'])
            ->where('id', $player->id)
            ->first();

        return new PlayerResource($player);
    }
}
