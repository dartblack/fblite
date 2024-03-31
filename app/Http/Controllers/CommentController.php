<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function __construct(
        protected CommentService $commentService,
        protected PostService    $postService,
    )
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $post = $this->postService->find($data['post_id']);

        $this->commentService->create($data);

        return Redirect::route('public.posts.show', [
            'id' => $post->id,
        ]);
    }

}
