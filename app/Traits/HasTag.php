<?php

namespace App\Traits;

use App\Models\Tag;

trait HasTag
{
    protected static function parseTags($model, $request)
    {
        $tags = [];
        preg_match_all('/#(\w+)/i', $request, $tags);
        $tagIdsToSync = [];
        foreach ($tags[0] as $tag) {
            array_push($tagIdsToSync, Tag::whereName($tag)->firstOrCreate(["name" => $tag])->id);
        }
        $model->tags()->sync($tagIdsToSync);
    }
}
