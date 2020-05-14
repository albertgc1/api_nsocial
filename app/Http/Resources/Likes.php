<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Likes extends JsonResource
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
            'user' => $this->user->name,
            'last_name' => $this->user->last_name,
            'avatar' => $this->user->avatar,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
