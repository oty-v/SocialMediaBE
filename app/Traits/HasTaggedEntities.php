<?php

namespace App\Traits;

use App\Models\Tag;

trait HasTaggedEntities
{
    public function hasTaggedEntities()
    {
        return $this->posts->count() + $this->comments->count() !== 0;
    }
}
