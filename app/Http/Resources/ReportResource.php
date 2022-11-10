<?php

namespace App\Http\Resources;

use App\Http\Controllers\Api\ArtworkController;
use App\Models\Artwork;
use App\Models\Comment;
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
            'reporter_id' => $this->user_report_id,
            'report_type' => $this->reportable_type,
            'reportable_id' => $this->when($this->whenLoaded('reportable'), function () {
                return $this->reportable_id;
            }),
            'reportable_type' => $this->when($this->whenLoaded('reportable'), function () {
                if ($this->reportable_type == 'artwork') {
                    $artwork_id = $this->reportable->id;
                    $artworks = Artwork::find($artwork_id)->with('likes',
                        'image:id,resize_path',
                        'comments:id,artwork_id,description',
                        'category',
                        'tags:id,tag_name')->first();
                    return new ArtworkResource($artworks);
                }
                if ($this->reportable_type == 'user') {
                    $user_id = $this->reportable->id;
                    $user = User::find($user_id)->with(['artist:id',
                        'wallet:id,balance,point',
                        'artworks:id,artist_id,image_id,art_name,price,description',
                        'followers',
                        'followees'])->first();
                    return new UserResource($user);
                }
                if ($this->reportable_type == 'comment') {
                    return $this->reportable;
                }

                return null;
            }),
            'description' => $this->description,
        ];
    }
}

