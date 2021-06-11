<?php

namespace App\Traits;

use App\Models\Tag;

trait HasTagTrait
{
    protected static function attachTags($model, $request)
    {
        $tags = [];
        preg_match_all('/#(\w+)/i', $request, $tags);
        foreach ($tags[0] as $tag) {
            $tag_exist = Tag::whereName($tag)->firstOrCreate(["name" => $tag]);
            $model->tags()->attach($tag_exist->id);
        }
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}
