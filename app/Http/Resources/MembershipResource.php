<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class MembershipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Get the current application locale
        $locale = app()->getLocale();

        // Transform the feature list based on the current locale
        $translatedFeatures = array_map(function ($feature) use ($locale) {
            return $feature[$locale] ?? $feature['en']; // Default to 'en' if the desired locale is not available
        }, $this->feature_list);

        return [
            'id'            => $this->id,
            'title'         => $this->getTranslation('title', app()->getLocale()),
            'feature_list'  => $translatedFeatures,
            'status'        => $this->status,
            'membership_durations' => MembershipDurationResource::collection($this->whenLoaded('membershipDurations'))
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
