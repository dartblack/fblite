<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [IndexController::class, 'index']);
Route::get('/post/{id}', [PostController::class, 'show'])->name('public.posts.show');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/dashboard/posts', PostController::class);

    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');

    Route::post('/rank/create-post-rank', [RankController::class, 'createPostRank'])->name('rank.createPostRank');
    Route::post('/rank/create-comment-rank', [RankController::class, 'createCommentRank'])->name('rank.createCommentRank');
});


require __DIR__ . '/auth.php';
