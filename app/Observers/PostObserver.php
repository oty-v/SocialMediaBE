<?php

namespace App\Observers;

use App\Models\Post;
use App\Traits\HasTagTrait;

class PostObserver
{
    use HasTagTrait;

    public function created(Post $post)
    {
        $this->attachTags($post, request('content'));
    }

    public function updated(Post $post)
    {
        $tags = $post->tags;
        $post->tags()->detach();
        foreach ($tags as $tag) {
            $tag->delete();
        }
        $this->attachTags($post, request('content'));
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
