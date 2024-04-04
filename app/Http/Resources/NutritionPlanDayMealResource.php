<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NutritionPlanDayMealResource extends JsonResource
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
            "id"                    => $this->id,
            "nutrition_plan_day_id" => $this->nutrition_plan_day_id,
            "meal_id"               => $this->meal_id,
            "meal_type_id"          => $this->meal_type_id,
            "name"                  => $this->name,
            "diet_type"             => $this->diet_type,
            "calories"              => $this->calories,
            "carbs"                 => $this->carbs,
            "fats"                  => $this->fats,
            "protein"               => $this->protein,
            "image"                 => $this->image,
            "status"                => $this->status,
            "created_at"            => $this->created_at,
            "meal_type"             => new MealTypeResource($this->mealType)
//            'meal'                  => new MealResource($this->meal)
        ];
    }
}
