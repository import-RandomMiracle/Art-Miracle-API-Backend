<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'user_report_id' => UserResource::collection($this->whenLoaded('users')),
            'reportable_id' => UserResource::collection($this->whenLoaded('users')),
            'reportable_type' => $this->when($this->whenLoaded('reportable'), function () {
                if ($this->reportable_type->reportable instanceof App\Artwork) {
                    return new ArtworkResource($this->reportable_type->reportable);
                }
                if ($this->reportable_type->reportable instanceof App\User) {
                    return new UserResource($this->reportable_type->reportable);
                }

                if ($this->reportable_type->reportable instanceof App\Comment) {
                    return new CommentResource($this->reportable_type->reportable);
                }

                return null;
            }),

            'description' => $this->description,
        ];
    }
}
