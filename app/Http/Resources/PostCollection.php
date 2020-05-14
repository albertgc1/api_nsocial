<?php

namespace App\Http\Resources;

use App\Like;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $like_me = Like::where('post_id', $this->id)->where('user_id', $request->user()->id)->first();
        return [
            'id' => $this->id,
            'description' => $this->description,
            'photo' => $this->photo,
            'created_at' => $this->created_at->diffForhumans(),
            'user' => ([
                'name' => $this->user->name,
                'last_name' => $this->user->last_name,
                'avatar' => $this->user->avatar
            ]),
            'comments' => $this->comments->count(),
            'likes' => $this->likes->count(),
            'like_me' => $like_me ? true : false
        ];
    }
}
