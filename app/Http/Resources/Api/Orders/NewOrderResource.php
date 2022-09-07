<?php

namespace App\Http\Resources\Api\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

class NewOrderResource extends JsonResource
{
    public function toArray($request = null)
    {
        return [
            'id'            => $this->resource->id,
            'order_number'  => $this->resource->order_number,
            'status_code'   => $this->resource->status_code
        ];
    }
}
