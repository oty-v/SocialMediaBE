<?php

namespace App\Observers;

use App\Models\Tag;

class TagObserver
{
    public function deleting(Tag $tag)
    {
        if ($tag->posts->count() + $tag->comments->count() !== 0) {
            return false;
        }
    }
}
