<?php

namespace App\Observers;

use App\Models\Post;
use App\Traits\HasTag;

class PostObserver
{
    use HasTag;

    public function created(Post $post)
    {
        $this->parseTags($post, request('content'));
    }

    public function updated(Post $post)
    {
        $tags = $post->tags;
        $post->tags()->detach();
        foreach ($tags as $tag) {
            $tag->delete();
        }
        $this->parseTags($post, request('content'));
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
