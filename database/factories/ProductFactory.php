<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'price' => fake()->numberBetween(15000, 50000),
            'stock' => fake()->numberBetween(10, 100),
            'description' => fake()->sentence(),
            'image' => null,
        ];
    }
}
