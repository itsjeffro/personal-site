<?php

namespace App\Http\Controllers\Api\External;

use App\Events\RepliedToTopic;
use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Event;

class TopicReplyController
{
    /** @var Reply */
    private $reply;

    /** @var Dispatcher */
    private $dispatcher;

    public function __construct(Reply $reply, Dispatcher $dispatcher)
    {
        $this->reply = $reply;
        $this->dispatcher = $dispatcher;
    }

    public function index(Topic $topic): JsonResponse
    {
        $replies = $this->reply
            ->with('author', 'author.player')
            ->where('topic_id', $topic->id)
            ->paginate(Reply::DEFAULT_PER_PAGE);

        return response()->json($replies);
    }

    public function store(ReplyRequest $request, Topic $topic): JsonResponse
    {
        $reply = new Reply();

        $reply->topic_id = $topic->id;
        $reply->user_id = auth()->id();
        $reply->body = $request->get('body');

        $reply->save();

        $this->dispatcher->dispatch(new RepliedToTopic($topic));

        return response()->json($reply, 201);
    }
}
