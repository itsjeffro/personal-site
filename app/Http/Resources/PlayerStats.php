<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerStats extends JsonResource
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
            'id' => $this->id,
            'player_name' => $this->name,
            'avatar' => $this->player->avatar,
            'kills' => $this->kills,
            'deaths' => $this->deaths,
            'hits' => $this->hits,
            'shots' => $this->shots,
            'headshots' => $this->headshots,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
