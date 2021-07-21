<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_title' => $this->product_title,
            'price' => (float) $this->price,
            'quantity' => (int) $this->quantity,
        ];
    }
}
