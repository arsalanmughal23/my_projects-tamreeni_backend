<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class RecipeResource extends JsonResource
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
            "id" => $this->id,
            "diet_type" => $this->diet_type,
            "title" => $this->getTranslation('title', app()->getLocale()),
            "description" => $this->getTranslation('description', app()->getLocale()),
            "image" => $this->image,
            "instruction" => $this->getTranslation('instruction', app()->getLocale()),
            "units_in_recipe" => $this->units_in_recipe,
            "divide_recipe_by" => $this->divide_recipe_by,
            "number_of_units" => $this->number_of_units,
            "calories" => $this->calories,
            "carbs" => $this->carbs,
            "fats" => $this->fats,
            "protein" => $this->protein,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at,
            "meal_type_id" => $this->meal_type_id,
            "meal_type_name" => $this->meal_type_name,
            "meal_category_ids" => $this->meal_category_ids,
            "meal_category_names" => $this->meal_category_names,
            "recipe_ingredients" => RecipeIngredientResource::collection($this->whenLoaded('recipeIngredients')),
            "meal_type" => new MealTypeResource($this->whenLoaded('meal_type'))
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
