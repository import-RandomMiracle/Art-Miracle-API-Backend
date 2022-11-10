<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $all_image = Storage::allFiles('public/avatar');
        $random_image = explode ("/", $all_image[random_int(0,49)]);

        return [
            'user_name' => fake()->userName(),
            'wallet_id' => Wallet::factory()->create()->id,
            'display_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'image' => Storage::url('avatar/' . $random_image[2]),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
