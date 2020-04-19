<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Reply;
use App\User;

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

    /**
     * Topic belongs to user.
     *
     * @return void
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Topic latest reply.
     *
     * @return void
     */
    public function latestReply()
    {
        return $this->hasOne(Reply::class)->latest();
    }
}
