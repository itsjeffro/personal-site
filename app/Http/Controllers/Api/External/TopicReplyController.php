<?php

namespace App\Http\Controllers\Api\External;

use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;

class TopicReplyController
{
    /** @var Reply */
    private $reply;

    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    public function index(Topic $topic): JsonResponse
    {
        $replies = $this->reply
            ->with('author')
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

        return response()->json($reply, 201);
    }
}
