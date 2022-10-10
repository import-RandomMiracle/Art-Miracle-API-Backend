<?php

namespace App\Http\Resources;

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
//                if ($this->reportable_type == 'artwork') {
//                    return new ArtworkResource($this->reportable);
//                }
//                if ($this->reportable_type == 'user') {
//                    return new UserResource($this->reportable);
//                }
//                if ($this->reportable_type == 'comment') {
//                    return new CommentResource($this->reportable);
//                }
                return $this->reportable_id;
            }),
            'description' => $this->description,
        ];
    }
}
