<?php

namespace App\Http\Resources;

use App\Models\NutritionPlanDayMeal;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

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
            "meal_id"       => $this->meal_id,
            "meal_type_id"  => $this->meal_type_id,
            "name"          => $this->meal?->name,
            "diet_type"     => $this->meal?->diet_type,
            "calories"      => $this->calories,
            "carbs"         => $this->carbs,
            "fats"          => $this->fats,
            "protein"       => $this->protein,
            "image"         => $this->meal?->image,
            "status"        => $this->status,
            "created_at"    => $this->created_at,
            "meal_type"     => new MealTypeResource($this->mealType)
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
