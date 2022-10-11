<?php

namespace Database\Factories;

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
    {
        return [
            'art_name' => fake()->realText(random_int(15,30)),
            'path' => fake()->filePath(),
            'price' => fake()->optional()->randomFloat(1,10000),
            'description' => fake()->realText(50)
        ];
    }
}
