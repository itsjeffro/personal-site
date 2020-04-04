<?php

namespace App\Http\Controllers\Api\Internal;

use App\Player;
use Illuminate\Http\Request;
use App\Http\Resources\Player as PlayerResource;

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

        $players = $this->player
            ->with(['playerStats'])
            ->withCount(['admin'])
            ->paginate($perPage);

        return response()->json($players);
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

        return response()->json($player);
    }
}
