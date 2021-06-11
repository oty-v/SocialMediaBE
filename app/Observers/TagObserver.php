<?php

namespace App\Observers;

use App\Models\Tag;
use App\Traits\HasTaggedEntities;

class TagObserver
{
    use HasTaggedEntities;

    public function deleting(Tag $tag)
    {
        if ($tag->hasTaggedEntities) {
            return false;
        }
    }
}
