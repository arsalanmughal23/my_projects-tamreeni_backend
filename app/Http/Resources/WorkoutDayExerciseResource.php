<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class WorkoutDayExerciseResource extends JsonResource
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
            'id'            => $this->id,
            'name'          => $this->getTranslation('name', app()->getLocale()),
            'description'   => $this->getTranslation('description', app()->getLocale()),
            'exercise_category_name'=> $this->exercise_category_name,
            'exercise_type_name'    => $this->exercise_type_name,
            'image'                 => $this->image,
            'video'                 => $this->video,
            'sets'          => $this->sets,
            'reps'          => $this->reps,
            'duration_in_m' => $this->duration_in_m,
            'burn_calories' => $this->burn_calories,
            'workout_day_id'=> $this->workout_day_id,
            'exercise_id'   => $this->exercise_id,
            'body_part_id'  => $this->body_part_id,
            'status'        => $this->status,
            'created_at'    => $this->created_at,
            'body_part'     => new BodyPartResource($this->bodyPart)
            // 'exercise'      => new ExerciseResource($this->exercise)
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
