<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function updating(Post $post)
    {
        foreach ($post->tags as $tag) {
            if ($tag->posts->count() + $tag->comments->count() === 1) {
                $tag->delete();
            }
        }
        $post->tags()->detach();
    }

    public function deleting(Post $post)
    {
        foreach ($post->tags as $tag) {
            if ($tag->posts->count() + $tag->comments->count() === 1) {
                $tag->delete();
            }
        }
        $post->tags()->detach();
    }
}
