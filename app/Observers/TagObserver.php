<?php

namespace App\Observers;

use App\Models\Tag;

class TagObserver
{
    public function deleting(Tag $tag)
    {
        if ($tag->hasTaggedEntities) {
            return false;
        }
    }
}
