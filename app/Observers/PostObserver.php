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
    }

    public function updated(Post $post)
    {
        $tags = $post->tags()->get();
        $post->parseTags();
        foreach ($tags as $tag) {
            $tag->delete();
        }
    }

    public function deleting(Post $post)
    {
        $tags = $post->tags()->get();
        $post->tags()->detach();
        foreach ($tags as $tag) {
            $tag->delete();
        }
        foreach ($post->comments()->get() as $comment) {
            $comment->delete();
        }
    }
}
