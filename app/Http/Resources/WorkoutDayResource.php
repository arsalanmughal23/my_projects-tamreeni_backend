<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class WorkoutDayResource extends JsonResource
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
            'id'                    => $this->id,
            'workout_plan_id'       => $this->workout_plan_id,
            'name'                  => $this->getTranslation('name', app()->getLocale()),
            'description'           => $this->getTranslation('description', app()->getLocale()),
            'image'                 => $this->image,
            'date'                  => $this->date,
            'duration'              => $this->duration,
            'is_rest_day'           => $this->is_rest_day,
            'status'                => $this->status,
            'created_at'            => $this->created_at,
            'workout_day_exercises' => WorkoutDayExerciseResource::collection($this->whenLoaded('workoutDayExercises')),
            'body_parts'            => $this->body_parts,
            'equipments'            => $this->equipments
        ];
    }

    public static function collection($resource)
    {
        if ($resource instanceof LengthAwarePaginator) {
            return [
                'data'         => parent::collection($resource),
                'links'        => [
                    'first' => $resource->url(1),
                    'last'  => $resource->url($resource->lastPage()),
                    'prev'  => $resource->previousPageUrl(),
                    'next'  => $resource->nextPageUrl(),
                ],
                'current_page' => $resource->currentPage(),
                'from'         => $resource->firstItem(),
                'last_page'    => $resource->lastPage(),
                'path'         => $resource->path(),
                'per_page'     => $resource->perPage(),
                'to'           => $resource->lastItem(),
                'total'        => $resource->total(),
            ];
        }

        return parent::collection($resource);
    }
}
