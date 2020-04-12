<?php

namespace App\Http\Controllers\Api\External;

use App\PlayerStats;
use Illuminate\Http\Request;
use App\Http\Resources\PlayerStats as PlayerStatsResource;
use App\Game\Sort;

class PlayerStatsController
{
    /** @var PlayerStats */
    private $playerStats;

    /**
     * PlayerController
     *
     * @param PlayerStats $playerStats
     */
    public function __construct(PlayerStats $playerStats)
    {
        $this->playerStats = $playerStats;
    }

    /**
     * List player stats.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', PlayerStats::DEFAULT_PER_PAGE);

        // Sorts
        $requestedSort = $request->get('sort', '');

        $sort = new Sort(
            $requestedSort,
            $this->playerStats->sortDefault,
            $this->playerStats->sortableColumns
        );

        $playerStats = $this->playerStats
            ->with('player')
            ->orderBy($sort->getColumn(), $sort->getOrder())
            ->paginate($perPage);

        return PlayerStatsResource::collection($playerStats);
    }
}
