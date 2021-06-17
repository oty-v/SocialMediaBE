<?php

namespace App\Traits;

use App\Models\User;

trait HasMentions
{
    public function parseMentions()
    {
        preg_match_all('/@(\w+)/i', $this->content, $parsedMentions);
        $mentionsIdArray = [];
        foreach ($parsedMentions[1] as $parsedMention) {
            $user = User::firstWhere('username', $parsedMention);
            if($user){
                array_push($mentionsIdArray, $user->id);
            }
        }
        $this->users()->sync($mentionsIdArray);
    }

    public function users()
    {
        return $this->morphToMany(User::class, 'mention');
    }
}
