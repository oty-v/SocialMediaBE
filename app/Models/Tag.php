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
        return $query->where("name", $name);
    }

    public function taggable($related)
    {
        return $this->morphedByMany($related, 'taggable');
    }

    public function posts()
    {
        return $this->taggable(Post::class);
    }

    public function comments()
    {
        return $this->taggable(Comment::class);
    }
}
