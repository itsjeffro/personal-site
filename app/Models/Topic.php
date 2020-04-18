<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Reply;

class Topic extends Model
{
    use SoftDeletes;

    /** @var int */
    const DEFAULT_PER_PAGE = 25;

    /** @var string */
    protected $table = 'topics';

    /**
     * Topic has many replies.
     *
     * @return void
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
