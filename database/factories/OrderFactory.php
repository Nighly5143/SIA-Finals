<?php

namespace Database\Factories;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => fake()->randomElement(Customer::pluck('id')),
            'food_id' => fake()->randomElement(Food::pluck('id')),
            'quantity' => fake()->numberBetween(1, 10),
            'total_price' => fake()->randomElement(['50','150','100','200','250','300','350']),
        ];
    }
}
