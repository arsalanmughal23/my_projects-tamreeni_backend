<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleWorkoutDayExerciseResource extends JsonResource
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
            "id"             => $this->id,
            "workout_day_id" => $this->workout_day_id,
            "exercise_id"    => $this->exercise_id,
            "duration"       => $this->duration,
            "sets"           => $this->sets,
            "reps"           => $this->reps,
            "burn_calories"  => $this->burn_calories,
            "status"         => $this->status,
            "created_at"     => $this->created_at,
            'exercise'       => ExerciseResource::single($this->exercise)
        ];
    }
}
