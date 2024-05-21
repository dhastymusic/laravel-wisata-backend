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
            'name' => $this->faker->word,
            'description' => $this->faker->words(2, true),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'stock' => $this->faker->numberBetween(1, 100),
            'image' => $this->faker->imageUrl(640, 480, 'places', true),
            'category_id' => $this->faker->numberBetween(1, 2),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'criteria' => $this->faker->randomElement(['perorangan', 'rombongan']),
            'favorite' => $this->faker->boolean,
        ];
    }
}
