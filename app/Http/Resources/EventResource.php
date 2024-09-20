<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'               => $this->id,
            'title'            => $this->getTranslation('title', app()->getLocale()),
            'date'             => $this->date,
            'start_time'       => $this->start_time,
            'end_time'         => $this->end_time,
            'duration'         => $this->duration,
            'status'           => $this->status,
            'description'      => $this->getTranslation('description', app()->getLocale()),
            'image'            => $this->image,
            'record_video_url' => $this->record_video_url,
            'body_part_id'     => $this->body_part_id,
            'body_part'        => new BodyPartResource($this->bodyPart),
            'equipment_id'     => $this->equipment_id,
            'equipment'        => new ExerciseEquipmentResource($this->equipment),
            'user_id'          => $this->user_id,
            'user'             => $this->user,
            'is_interested'    => $this->is_interested,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
        ];
    }

    public static function collection($resource)
    {
        if ($resource instanceof LengthAwarePaginator) {
            return [
                'data'  => parent::collection($resource),
                'links' => [
                    'first' => $resource->url(1),
                    'last'  => $resource->url($resource->lastPage()),
                    'prev'  => $resource->previousPageUrl(),
                    'next'  => $resource->nextPageUrl(),
                ],
                'meta'  => [
                    'current_page' => $resource->currentPage(),
                    'from'         => $resource->firstItem(),
                    'last_page'    => $resource->lastPage(),
                    'path'         => $resource->path(),
                    'per_page'     => $resource->perPage(),
                    'to'           => $resource->lastItem(),
                    'total'        => $resource->total(),
                ],
            ];
        }

        return parent::collection($resource);
    }
}
