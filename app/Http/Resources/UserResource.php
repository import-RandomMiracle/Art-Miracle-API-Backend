<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'wallets' => WalletResource::collection($this->whenLoaded('wallets')),
            'Artist' => ArtistResource::collection($this->whenLoaded('artists')),
            'user_name' => $this->user_name,
            'display_name' => $this->display_name,
            'email' => $this->email,
            'role' => $this->role
        ];
    }
}
