<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class NutritionPlanDayResource extends JsonResource
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
            'id'                       => $this->id,
            'nutrition_plan_id'        => $this->nutrition_plan_id,
            'name'                     => $this->getTranslation('name', app()->getLocale()),
            'date'                     => $this->date,
            'day_target_calories'      => $this->day_target_calories,
            'day_take_in_calories'      => $this->day_take_in_calories,
            'status'                   => $this->status,
            'created_at'               => $this->created_at,
            'nutrition_plan_day_meals' => NutritionPlanDayMealResource::collection($this->whenLoaded('nutritionPlanDayMeals'))
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
