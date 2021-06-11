<?php

namespace App\Traits;

trait HasTaggedEntities
{
    public function hasTaggedEntities()
    {
        return $this->posts->count() + $this->comments->count() !== 0;
    }
}
