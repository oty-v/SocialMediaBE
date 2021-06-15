<?php

namespace App\Traits;

use App\Models\Tag;

trait HasTag
{
    public function parseTags($value)
    {
        preg_match_all('/#(\w+)/i', $value, $parsedTags);
        $tagsIdArray = [];
        foreach ($parsedTags[0] as $parsedTag) {
            $tag = Tag::whereName($parsedTag)->firstOrCreate(["name" => $parsedTag]);
            array_push($tagsIdArray, $tag->id);
        }
        $this->tags()->sync($tagsIdArray);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
