<?php

namespace App\Models;

use App\Traits\HasTagTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory, HasTagTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
    ];

    public function scopeWhereHasTag($query, $name)
    {
        return $name ? $query->whereHas(
            'tags',
            function (Builder $query) use ($name) {
                $query->whereName($name);
            }
        )->orWhereHas(
            'comments.tags',
            function (Builder $query) use ($name) {
                $query->whereName($name);
            }
        ) : $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
