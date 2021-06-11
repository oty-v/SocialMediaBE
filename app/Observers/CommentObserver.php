<?php

namespace App\Observers;

use App\Models\Comment;
use App\Traits\HasTagTrait;

class CommentObserver
{
    use HasTagTrait;

    public function created(Comment $comment)
    {
        $this->attachTags($comment, request('body'));
    }

    public function updated(Comment $comment)
    {
        $tags = $comment->tags;
        $comment->tags()->detach();
        foreach ($tags as $tag) {
            $tag->delete();
        }
        $this->attachTags($comment, request('body'));
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
