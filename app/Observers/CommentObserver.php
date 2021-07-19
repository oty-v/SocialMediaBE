<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function created(Comment $comment)
    {
        $comment->parseTags();
        $comment->parseMentions();
    }

    public function updated(Comment $comment)
    {
        $tags = $comment->tags()->get();
        $comment->parseTags();
        $comment->parseMentions();
        foreach ($tags as $tag) {
            $tag->delete();
        }
    }

    public function deleted(Comment $comment)
    {
        $tags = $comment->tags()->get();
        $comment->tags()->detach();
        $comment->mentionedUsers()->detach();
        $comment->usersWhoLiked()->detach();
        foreach ($tags as $tag) {
            $tag->delete();
        }
    }
}
