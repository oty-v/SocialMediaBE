<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function updating(Comment $comment)
    {
        foreach ($comment->tags as $tag) {
            if ($tag->posts->count() + $tag->comments->count() === 1) {
                $tag->delete();
            }
        }
        $comment->tags()->detach();
    }

    public function deleting(Comment $comment)
    {
        foreach ($comment->tags as $tag) {
            if ($tag->posts->count() + $tag->comments->count() === 1) {
                $tag->delete();
            }
        }
        $comment->tags()->detach();
    }
}
