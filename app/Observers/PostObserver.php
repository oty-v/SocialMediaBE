<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class PostObserver
{
    public function created(Post $post)
    {
        $post->parseTags();
        $post->parseMentions();
    }

    public function updated(Post $post)
    {
        $tags = $post->tags()->get();
        $post->parseTags();
        $post->parseMentions();
        foreach ($tags as $tag) {
            $tag->delete();
        }
    }

    public function deleting(Post $post)
    {
        $tags = $post->tags()->get();
        $post->tags()->detach();
        $post->mentionedUsers()->detach();
        $post->usersWhoLiked()->detach();
        foreach ($tags as $tag) {
            $tag->delete();
        }
        foreach ($post->comments()->get() as $comment) {
            $comment->delete();
        }
    }
}
