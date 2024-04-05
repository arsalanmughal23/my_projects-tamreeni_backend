<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $mealCategory = $this->mealCategory;

        return [
            'id'               => $this->id,
            'name'             => $this->getTranslation('name', app()->getLocale()),
            'description'      => $this->getTranslation('description', app()->getLocale()),
            'diet_type'        => $this->diet_type,
            'meal_category_id' => $this->meal_category_id,
            'meal_category'    => [
                'id'            => $mealCategory->id,
                'diet_type'     => $mealCategory->diet_type,
                'name'          => $mealCategory->getTranslation('name', app()->getLocale()),
                'deleted_at'    => $mealCategory->deleted_at,
                'created_at'    => $mealCategory->created_at,
                'updated_at'    => $mealCategory->updated_at,
            ],
            'image'            => $this->image,
            'calories'         => $this->calories,
            'is_favourite'     => $this->is_favourite,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
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
