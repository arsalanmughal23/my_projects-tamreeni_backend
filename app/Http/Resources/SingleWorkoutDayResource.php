<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleWorkoutDayResource extends JsonResource
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
//            'name'                  => $this->getTranslation('name', app()->getLocale()),
//            'description'           => $this->getTranslation('description', app()->getLocale()),
            'name'                  => $this->name,
            'description'           => $this->description,
            'image'                 => $this->image,
            'date'                  => $this->date,
            'duration'              => $this->duration,
            'status'                => $this->status,
            'created_at'            => $this->created_at,
            'workout_day_exercises' => SingleWorkoutDayExerciseResource::collection($this->whenLoaded('workoutDayExercises'))
        ];
    }
}
