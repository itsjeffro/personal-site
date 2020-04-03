<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use SoftDeletes;

    /** @var int */
    const DEFAULT_PER_PAGE = 25;

    /**
     * Player's overall stats.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function playerStats()
    {
        return $this->hasOne(PlayerStats::class, 'steam_id', 'steam_id');
    }

    /**
     * Player's admin record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function admin()
    {
        return $this->hasOne(AmxAdmin::class, 'auth', 'steam_id');
    }
}
