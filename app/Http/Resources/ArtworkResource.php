<?php

namespace App\Http\Resources;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtworkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'art_name' => $this->art_name,
            'artist' => User::select(['id','artist_id', 'user_name', 'display_name'])->where('artist_id', $this->id)->get(),
            'price' => $this->price,
            'path' => $this->path,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'likes_count' => count(LikeResource::collection($this->whenLoaded('likes'))),
            'description' => $this->description,
        ];
    }
}
