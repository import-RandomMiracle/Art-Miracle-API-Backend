<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_report_id' => random_int(1,User::count()),
            'reportable_id' => random_int(1,10),
            'reportable_type' => fake()->randomElement(['user','report','comment']),
            'description' => fake()->realText(30)
        ];
    }
}
