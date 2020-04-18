<?php

namespace App\Http\Controllers\Api\External;

use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TopicReplyController
{
    public function store(Request $request, Topic $topic): JsonResponse
    {
        $reply = new Reply();

        $reply->topic = $topic;
        $reply->user_id = auth()->id();
        $reply->body = $request->get('body');

        $reply->save();

        return response()->json($reply, 201);
    }
}
