<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtworkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'art_name' => $this->art_name,
            'path' => $this->path,
            'comments' => CommentResource::collection($this->comments),
            'tags' => TagResource::collection($this->tags),
            'categories' => CategoryResource::collection($this->categories),
            'likes_count' => count(LikeResource::collection($this->likes)),
            'description' => $this->description,
        ];
    }
}
