<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrderItemResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this -> id,
            'first_name' => $this -> first_name,
            'last_name' => $this -> last_name,
            'email' => $this -> email,
            'total' => $this->total,
            'order_items' => OrderItemResource::collection($this->orderItems),
        ];
    }
}
