<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerStats extends Model
{
    use SoftDeletes;

    /** @var int */
    const DEFAULT_PER_PAGE = 25;

    /** @var string */
    public $sortDefault = 'kills:desc';

    /** @var array[] */
    public $sortableColumns = [
        'id' => 'id', 
        'kills' => 'kills',
        'deaths' => 'deaths',
        'name' => 'name',
        'updated_at' => 'updated_at',
    ];

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
