<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use SoftDeletes;

    /** @var int */
    const DEFAULT_PER_PAGE = 25;
    
    /** @var string */
    protected $table = 'replies';
}
