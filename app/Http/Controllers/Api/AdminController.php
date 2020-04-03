<?php

namespace App\Http\Controllers\Api;

use App\Player;
use Illuminate\Http\Request;
use App\Http\Resources\Player as PlayerResource;

class AdminController
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
            ->withCount(['admin'])
            ->has('admin')
            ->paginate($perPage);

        return PlayerResource::collection($players);
    }
}
