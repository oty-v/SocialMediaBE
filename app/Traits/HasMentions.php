<?php

namespace App\Traits;

use App\Models\User;
use App\Events\MentionEvent;

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
                $author = $this->user->username;
                $post = $this->post->id ?? $this->id;
                event(new MentionEvent($user->username, $author, $post));
            }
        }
        $this->mentionedUsers()->sync($mentionsIdArray);
    }

    public function mentionedUsers()
    {
        return $this->morphToMany(User::class, 'mention');
    }
}
