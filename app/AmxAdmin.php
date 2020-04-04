<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmxAdmin extends Model
{
    /** @var string */
    protected $table = 'admins';

    /** @var string|null */
    protected $primaryKey = null;

    /** @var bool */
    public $incrementing = false;

    /** @var bool */
    public $timestamps = false;

    /** @var int */
    const DEFAULT_PER_PAGE = 25;

    /**
     * Admin's player record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function player()
    {
        return $this->hasOne(Player::class, 'steam_id', 'auth');
    }

    /**
     * Admin's player stats record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function playerStats()
    {
        return $this->hasOne(PlayerStats::class, 'steam_id', 'auth');
    }
}
