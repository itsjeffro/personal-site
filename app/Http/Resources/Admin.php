<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PlayerStats as PlayerStatsResource;

class Admin extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'auth' => $this->auth,
            'access' => str_split($this->access),
            'flags' => str_split($this->flags),
            'player' => $this->player,
            'stats' => $this->playerStats,
        ];
    }
}
