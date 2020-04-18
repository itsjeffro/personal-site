<?php

namespace App\Http\Controllers\Api\External;

use App\Http\Requests\TopicRequest;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class TopicController
{
    /** @var Topic */
    private $topic;
    
    /** @var Str */
    private $string;

    /**
     * @param Topic $topic
     * @param Str $string
     */
    public function __construct(Topic $topic, Str $string)
    {
        $this->topic = $topic;
        $this->string = $string;
    }

    /**
     * List topics.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $topics = $this->topic->paginate(Topic::DEFAULT_PER_PAGE);

        return response()->json($topics);
    }

    /**
     * Show topic and replies.
     *
     * @param Topic $topic
     * @return JsonResponse
     */
    public function show(Topic $topic): JsonResponse
    {
        $topic = $topic->with(['replies'])->first();

        return response()->json($topic);
    }

    /**
     * Create topic.
     *
     * @param TopicRequest $request
     * @return JsonResponse
     */
    public function store(TopicRequest $request): JsonResponse
    {
        $title = $request->get('title');
        $slug = $this->string::slug($title);

        $slugExists = $this->topic
            ->where('slug', $slug)
            ->count();

        if ($slugExists > 0) {
            $slug = $slug . '-' . time();
        }

        $topic = new Topic();

        $topic->user_id = auth()->id();
        $topic->title = $request->get('title');
        $topic->slug = $slug;
        $topic->body = $request->get('body');

        $topic->save();

        return response()->json($topic, 201);
    }

    /**
     * Update topic.
     *
     * @param TopicRequest $request
     * @return JsonResponse
     */
    public function update(TopicRequest $request, Topic $topic): JsonResponse
    {
        $topic->body = $request->get('body');

        $topic->save();

        return response()->json($topic, 200);
    }
}
