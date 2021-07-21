<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'author' => new UserResource($this->user),
            'tags' => TagResource::collection($this->tags),
            'mentionedUsers' => UserResource::collection($this->mentionedUsers),
            'numberOfLikes' => $this->countLikes(),
            'userLiked' => $this->userLikes(auth()->user()->username),
            'content' => $this->content,
            'created_at' => $this->created_at,
        ];
    }
}
