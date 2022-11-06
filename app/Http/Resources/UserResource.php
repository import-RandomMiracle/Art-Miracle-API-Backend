<?php

namespace App\Http\Resources;

use App\Models\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'wallet'            => $this->whenLoaded('wallet'),
            'artist'            => $this->whenLoaded('artist'),
            'has_artworks'      => $this->whenLoaded('artworks'),
            'user_name'         => $this->user_name,
            'display_name'      => $this->display_name,
            'follower_count'    => $this->whenLoaded('followers')->count(),
            'following_count'   => $this->whenLoaded('followees')->count(),
            'email'             => $this->email,
            'role'              => $this->role
        ];
    }
}
