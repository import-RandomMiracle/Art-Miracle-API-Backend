<?php

namespace App\Http\Resources;

use App\Models\Artist;
use App\Models\Like;
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
            'id'                => $this->id,
            'art_name'          => $this->art_name,
            'artist'            => $this->artist_id,
            'user'              => [
                'display_name'  => $this->artist->user->display_name,
                'user_name'     => $this->artist->user->user_name,
                'profile'       => $this->artist->user->image
            ],
            'price'             => $this->price,
            'point'             => $this->point,
            'image'             => $this->whenLoaded('image')->resize_path,
            'comments'          => $this->whenLoaded('comments'),
            'tags'              => $this->whenLoaded('tags'),
            'category'          => $this->whenLoaded('category')->category_name,
            'likes'             => $this->whenLoaded('likes')->count(),
            'description'       => $this->description,
        ];
    }
}
