<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function created(Comment $comment)
    {
        $comment->parseTags();
    }

    public function updated(Comment $comment)
    {
        $tags = $comment->tags()->get();
        $comment->parseTags();
        foreach ($tags as $tag) {
            $tag->delete();
        }
    }

    public function deleted(Comment $comment)
    {
        $tags = $comment->tags()->get();
        $comment->tags()->detach();
        foreach ($tags as $tag) {
            $tag->delete();
        }
    }
}
