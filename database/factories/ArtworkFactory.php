<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artwork>
 */
class ArtworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   $price = fake()->optional()->randomFloat(3, 0, 600.00);
        return [
            'art_name' => fake()->realText(random_int(15, 30)),
            'price' => number_format($price, 2, '.', ''),
            'description' => fake()->realText(50),
            'category_id' => Category::inRandomOrder()->first()->id
            ];
    }
}
