<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmxAdmin extends Model
{
    /** @var string */
    protected $table = 'admins';

    /** @var int */
    const DEFAULT_PER_PAGE = 25;
}
