<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
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
