<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function created(Comment $comment)
    {
        $comment->parseTags(request('body'));
    }

    public function updated(Comment $comment)
    {
        $tags = $comment->tags;
        $comment->parseTags(request('body'));
        foreach ($tags as $tag) {
            $tag->delete();
        }
    }

    public function deleting(Comment $comment)
    {
        $tags = $comment->tags;
        $comment->tags()->detach();
        foreach ($tags as $tag) {
            $tag->delete();
        }
    }
}
