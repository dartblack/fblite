<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostSearchRequest;
use App\Services\PostService;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class IndexController extends Controller
{
    public function __construct(
        protected PostService $postService
    )
    {
    }

    public function index(PostSearchRequest $request): Response
    {
        $posts = $this->postService->search($request->validated('query'));
        return Inertia::render('Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'posts' => $posts,
        ]);
    }
}
