<?php

namespace App\Traits;

use App\Models\User;

trait HasLikes
{

    public function countLikes()
    {
        return $this->usersWhoLiked()->count();
    }

    public function userLikes($username)
    {
        return $this->usersWhoLiked()->firstWhere("username", $username) !== null;
    }

    public function like($user)
    {
        $this->usersWhoLiked()->syncWithoutDetaching([$user->id]);
    }

    public function unlike($user)
    {
        $this->usersWhoLiked()->detach($user->id);
    }

    public function usersWhoLiked()
    {
        return $this->morphToMany(User::class, 'like');
    }
}
