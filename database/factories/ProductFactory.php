<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'category' => $this->faker->randomElement(['Food', 'Grooming', 'Toys']),
            'price' => $this->faker->randomFloat(2, 100, 2000),
            'stock_quantity' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->sentence(),
        ];
    }
}
