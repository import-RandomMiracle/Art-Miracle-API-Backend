<?php

namespace Database\Factories;

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
            'reportable_type' => fake()->randomElement(['App\Models\User','App\Models\Report','App\Models\Comment']),
            'description' => fake()->realText(30)
        ];
    }
}
