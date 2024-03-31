<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $userPosts = $this->postService->where('user_id', '=', Auth::id());
        return Inertia::render('Post/Index', ['userPosts' => $userPosts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Post/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $this->postService->create($data);

        return Redirect::route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        $post = $this->postService->find($id);
        $post->load('user', 'comments');
        return Inertia::render('Post/View', [
            'postData' => [
                'id' => $post->id,
                'title' => $post->title,
                'short_desc' => $post->short_desc,
                'desc' => $post->desc,
                'created_at' => $post->created_at,
                'likes' => $post->likes,
                'dislikes' => $post->dislikes,
                'comments' => $post->comments()->with('user')->orderBy('id', 'desc')->get(),
                'user' => $post->user()->first(),
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): Response
    {
        return Inertia::render('Post/Edit', [
            'postData' => [
                'id' => $post->id,
                'title' => $post->title,
                'short_desc' => $post->short_desc,
                'desc' => $post->desc,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $this->postService->update($request->validated(), $post->id);

        return Redirect::route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->postService->delete($post->id);

        return Redirect::route('posts.index');
    }
}
