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
            $tagId = Tag::whereName($parsedTag)->firstOrCreate(["name" => $parsedTag])->id;
            array_push($tagsIdArray, $tagId);
        }
        $this->tags()->sync($tagsIdArray);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
