<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerStats extends Model
{
    use SoftDeletes;

    /** @var int */
    const DEFAULT_PER_PAGE = 25;

    /**
     * Player's overall stats.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function player()
    {
        return $this->hasOne(Player::class, 'steam_id', 'steam_id');
    }
}
