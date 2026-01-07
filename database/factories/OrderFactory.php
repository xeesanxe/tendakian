<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'order_number' => strtoupper($this->faker->bothify('ORD-########')),
            'status' => 'pending',
            'total' => 0,
            'shipping_address' => $this->faker->address(),
        ];
    }
}
