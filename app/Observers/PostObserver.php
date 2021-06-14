<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function created(Post $post)
    {
        $post->parseTags(request('content'));
    }

    public function updated(Post $post)
    {
        $tags = $post->tags;
        $post->parseTags(request('content'));
        foreach ($tags as $tag) {
            $tag->delete();
        }
    }

    public function deleting(Post $post)
    {
        $tags = $post->tags;
        $post->tags()->detach();
        foreach ($tags as $tag) {
            $tag->delete();
        }
    }
}
