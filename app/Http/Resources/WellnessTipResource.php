<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class WellnessTipResource extends JsonResource
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
            "title" => $this->getTranslation('title', app()->getLocale()),
            "content" => $this->getTranslation('content', app()->getLocale()),
            "cover" => $this->cover,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at
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
