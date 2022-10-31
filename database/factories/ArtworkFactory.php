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
            'art_name' => fake()->realText(random_int(15, 30)),
            'price' => function () {
                $price = fake()->optional()->randomFloat(3, 0, 600.00);
                if ($price != null)
                    return number_format($price, 2, '.', '');
                return null;
            },
            'description' => fake()->realText(50)];
    }
}
