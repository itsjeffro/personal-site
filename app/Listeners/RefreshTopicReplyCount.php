<?php

namespace App\Listeners;

use App\Events\RepliedToTopic;
use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RefreshTopicReplyCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RepliedToTopic  $event
     * @return void
     */
    public function handle(RepliedToTopic $event)
    {
        $topic = $event->topic;

        if ($topic instanceof Topic) {
            $replyCount = Reply::where('topic_id', $topic->id)->count();

            $topic->replies = $replyCount;
            $topic->save();
        }
    }
}
