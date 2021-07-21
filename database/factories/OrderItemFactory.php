<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'product_title' => $this->faker->text(30),
            'price' => $this->faker->numberBetween(10,100),
            'quantity' => $this->faker->numberBetween(1,5),
        ];
    }
}
