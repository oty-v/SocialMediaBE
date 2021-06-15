<?php

namespace App\Traits;

use App\Models\Tag;

trait HasTags
{
    public function parseTags()
    {
        preg_match_all('/#(\w+)/i', $this->content, $parsedTags);
        $tagsIdArray = [];
        foreach ($parsedTags[1] as $parsedTag) {
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
