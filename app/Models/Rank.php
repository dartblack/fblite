<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rank extends Model
{
    use HasFactory;

    const TYPE_POST = 'post';
    const TYPE_COMMENT = 'comment';
    const RATE_LIKE = 'like';
    const RATE_DISLIKE = 'dislike';
    const COMMENT_LIKE = 3;
    const COMMENT_DISLIKE = -1;
    const POST_LIKE = 5;
    const POST_DISLIKE = -1;

    protected $fillable = ['type', 'rate', 'entity_id', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
