<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->user->id,
            'username' => $this->user->username,
            'name' => $this->name,
            'avatar' => $this->avatar_url,
            'email' => $this->user->email,
            'created_at' => $this->user->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
