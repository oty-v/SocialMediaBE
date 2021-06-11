<?php

namespace App\Observers;

use App\Models\Comment;
use App\Traits\HasTag;

class CommentObserver
{
    use HasTag;

    public function created(Comment $comment)
    {
        $this->parseTags($comment, request('body'));
    }

    public function updated(Comment $comment)
    {
        $tags = $comment->tags;
        $comment->tags()->detach();
        foreach ($tags as $tag) {
            $tag->delete();
        }
        $this->parseTags($comment, request('body'));
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
