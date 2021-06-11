<?php

namespace App\Traits;

use App\Models\Tag;

trait HasRelationWithTags
{
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
