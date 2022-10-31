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
            'price'             => $this->price,
            'image_id'          => $this->image_id,
            'comments'          => $this->comments,
            'tags'              => $this->tags,
            'categories'        => $this->categories,
            'likes'             => Like::where('artwork_id', $this->id)->count(),
            'description'       => $this->description,
        ];
    }
}
