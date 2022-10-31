<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $all_image = Storage::allFiles('public/artwork/real-size');
        $random_image = explode ("/", $all_image[random_int(0,3)]);
        return [
            'real_path' => Storage::url('artwork/real-size/' . $random_image[3]),
            'resize_path' => Storage::url('artwork/resize/' . $random_image[3]),
        ];
    }
}
