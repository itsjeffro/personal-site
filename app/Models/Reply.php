<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Reply extends Model
{
    use SoftDeletes;

    /** @var int */
    const DEFAULT_PER_PAGE = 25;
    
    /** @var string */
    protected $table = 'replies';

    /**
     * Reply belongs to user.
     *
     * @return void
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
