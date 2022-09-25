<?php

namespace Database\Factories;

use App\Models\Artwork;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $artworks = Artwork::get();
        $users = User::get();
        return [
            'artwork_id' => $artworks->random()->id,
            'user_id' => $users->random()->id,
            'description' => fake()->realText(30)
        ];
    }
}
