<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class AppointmentResource extends JsonResource
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
            'id'              => $this->id,
            // 'customer_id'     => $this->customer_id,
            // 'customer'        => $this->customer,
            'date'            => $this->date,
            'start_time'      => $this->start_time,
            'end_time'        => $this->end_time,
            'currency'        => $this->currency,
            'amount'          => $this->amount,
            'type'            => $this->type,
            'profession_type' => $this->profession_type,
            'status'          => $this->status,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
            'user_id'         => $this->user_id,
            'slot_id'         => $this->slot_id,
            'package_id'      => $this->package_id,
            'user'            => $this->user,
            'slot'            => $this->slot,
            'package'         => $this->package,
            'transaction' => new TransactionResource($this->transaction)
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
