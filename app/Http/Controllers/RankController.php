<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRankRequest;
use App\Models\Rank;
use App\Models\User;
use App\Services\CommentService;
use App\Services\PostService;
use App\Services\RankService;
use Illuminate\Support\Facades\Auth;

class RankController extends Controller
{
    public function __construct(
        protected RankService    $rankService,
        protected PostService    $postService,
        protected CommentService $commentService,
    )
    {
    }

    public function createPostRank(CreateRankRequest $request): void
    {
        $post = $this->postService->find($request->validated('entity_id'));

        $isLike = $request->validated('isLike');
        $rateType = $isLike ? Rank::RATE_LIKE : Rank::RATE_DISLIKE;
        $rank = $this->rankService->findBy(Rank::TYPE_POST, Auth::id(), $post->id);
        if ($rank) {
            $this->rankService->update(['rate' => $rateType], $rank->id);
        } else {
            $rank = $this->rankService->create([
                'type' => Rank::TYPE_POST,
                'rate' => $rateType,
                'user_id' => Auth::id(),
                'entity_id' => $post->id,
            ]);
        }

        $postLikes = $this->rankService->rateCounts(Rank::TYPE_POST, Rank::RATE_LIKE, $post->id);
        $postDisLikes = $this->rankService->rateCounts(Rank::TYPE_POST, Rank::RATE_DISLIKE, $post->id);
        $this->postService->update([
            'likes' => $postLikes,
            'dislikes' => $postDisLikes,
        ], $post->id);
        $this->calculateUserRank($post->user_id);
    }


    public function createCommentRank(CreateRankRequest $request): void
    {
        $comment = $this->commentService->find($request->validated('entity_id'));
        $rateType = $request->validated('isLike') ? Rank::RATE_LIKE : Rank::RATE_DISLIKE;
        $rank = $this->rankService->findBy(Rank::TYPE_COMMENT, Auth::id(), $comment->id);
        if ($rank) {
            $this->rankService->update(['rate' => $rateType], $rank->id);
        } else {
            $rank = $this->rankService->create([
                'type' => Rank::TYPE_COMMENT,
                'rate' => $rateType,
                'user_id' => Auth::id(),
                'entity_id' => $comment->id,
            ]);
        }

        $commentLikes = $this->rankService->rateCounts(Rank::TYPE_COMMENT, Rank::RATE_LIKE, $comment->id);
        $commentDisLikes = $this->rankService->rateCounts(Rank::TYPE_COMMENT, Rank::RATE_DISLIKE, $comment->id);

        $this->commentService->update([
            'likes' => $commentLikes,
            'dislikes' => $commentDisLikes,
        ], $comment->id);
        $this->calculateUserRank($comment->user_id);
    }

    private function calculateUserRank(int $userId): void
    {
        $user = User::find($userId);
        $postLikes = $this->postService->userPostLikes($userId);
        $postDisLikes = $this->postService->userPostDisLikes($userId);

        $commentLikes = $this->commentService->userCommentLikes($userId);
        $commentDisLikes = $this->commentService->userCommentDisLikes($userId);

        $rank = ($postLikes * Rank::POST_LIKE) + ($postDisLikes * Rank::POST_DISLIKE);
        $rank += ($commentLikes * Rank::COMMENT_LIKE) + ($commentDisLikes * Rank::COMMENT_DISLIKE);
        $user->rating = $rank;
        $user->save();
    }
}
