<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class UserMembershipResource extends JsonResource
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
            'id'            => $this->id,
            'title'         => $this->getTranslation('title', app()->getLocale()),
            'user_id'       => $this->user_id,
            'membership_id' => $this->membership_id,
            'membership_duration_id'    => $this->membership_duration_id,
            'duration_in_month'         => $this->duration_in_month,
            'expire_at'     => $this->expire_at,
            'status'        => $this->status,

            'promo_code_id' => $this->promo_code_id,
            'promo_code'    => $this->promo_code,
            'original_price'=> $this->original_price,
            'discount'      => $this->discount,
            'charge_amount' => $this->charge_amount,

            'transactions' => TransactionResource::collection($this->whenLoaded('transactions')),
            'membership' => new MembershipResource($this->membership),
            // 'membership_duration' => new MembershipDurationResource($this->membershipDuration)
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
