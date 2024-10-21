<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class ExerciseResource extends JsonResource
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
            'id'                  => $this->id,
            'is_finisher'         => $this->is_finisher,
            'name'                => $this->getTranslation('name', app()->getLocale()),
            'description'         => $this->getTranslation('description', app()->getLocale()),
            'user_id'             => $this->user_id,
            'user'                => $this->user,
            'body_part_id'        => $this->body_part_id,
            'body_part'           => new BodyPartResource($this->bodyPart),
            'is_favourite'        => $this->is_favourite,
            'duration_in_m'       => $this->duration_in_m,
            'sets'                => $this->sets,
            'reps'                => $this->reps,
            'burn_calories'       => $this->burn_calories,
            'image'               => $this->image,
            'audio'               => $this->audio,
            'video'               => $this->video,
            'exercise_equipments' => ExerciseEquipmentResource::collection($this->whenLoaded('equipment')),
            'created_at'          => $this->created_at,
            'updated_at'          => $this->updated_at,
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

    // public static function single($resource)
    // {
    //     return [
    //         'id'            => $resource->id,
    //         'name'          => $resource->getTranslation('name', app()->getLocale()),
    //         'description'   => $resource->getTranslation('description', app()->getLocale()),
    //         'user_id'       => $resource->user_id,
    //         'body_part_id'  => $resource->body_part_id,
    //         'body_part'     => $resource->bodyPart,
    //         'is_favourite'  => $resource->is_favourite,
    //         'duration_in_m' => $resource->duration_in_m,
    //         'sets'          => $resource->sets,
    //         'reps'          => $resource->reps,
    //         'burn_calories' => $resource->burn_calories,
    //         'image'         => $resource->image,
    //         'video'         => $resource->video,
    //         'created_at'    => $resource->created_at,
    //     ];
    // }
}
