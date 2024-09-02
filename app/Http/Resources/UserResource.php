<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class UserResource extends JsonResource
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
            'stripe_customer_id'    => $this->stripe_customer_id,
            'name'                  => $this->name,
            'email'                 => $this->email,
            'email_verified_at'     => $this->email_verified_at,
            'status'                => $this->status,
            'trail_expire_at'       => $this->trail_expire_at,
            'is_trail_available'    => $this->is_trail_available,
            'deleted_at'            => $this->deleted_at,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
            'active_membership'     => new UserMembershipResource($this->active_membership),
            'details'               => $this->details
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
