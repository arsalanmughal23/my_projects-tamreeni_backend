<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class NutritionPlanDayRecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'diet_type'             => $this->diet_type,
            'nutrition_plan_day_id' => $this->nutrition_plan_day_id,
            'title'                 => $this->getTranslation('title', app()->getLocale()),
            'description'           => $this->getTranslation('description', app()->getLocale()),
            'instruction'           => $this->getTranslation('instruction', app()->getLocale()),
            'image'                 => $this->image,
            'units_in_recipe'       => $this->units_in_recipe,
            'divide_recipe_by'      => $this->divide_recipe_by,
            'number_of_units'       => $this->number_of_units,
            'calories'              => $this->calories,
            'carbs'                 => $this->carbs,
            'fats'                  => $this->fats,
            'protein'               => $this->protein,
            'status'                => $this->status,
            'is_favourite'          => $this->is_favourite,
            'created_at'            => $this->created_at,
            'recipe_id'             => $this->recipe_id,
            'meal_type_id'          => $this->meal_type_id,
            'meal_type_name'        => $this->meal_type_name,
            // 'meal_category_ids'     => $this->meal_category_ids,
            'meal_category_names'   => $this->meal_category_names,
            'recipe_ingredients'    => NplanDayRecipeIngredientResource::collection($this->whenLoaded('nPlanDayRecipeIngredients'))
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
