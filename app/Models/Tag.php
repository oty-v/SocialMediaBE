<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function scopeWhereName($query, $name)
    {
        return $name ? $query->where("name", $name) : $query;
    }

    public function getHasTaggedEntitiesAttribute()
    {
        return $this->posts->count() + $this->comments->count() !== 0;
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphedByMany(Comment::class, 'taggable');
    }
}
