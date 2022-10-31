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
        $url = fake()->imageUrl();
//        $contents = file_get_contents($url);
        $name = "test";
        $imageFile = Storage::put('test/' . $name . '.jpg',$url);

        return [
//            'real_path' => Storage::disk('public')->putFile('images', $imageFile)
        ];
    }
}
