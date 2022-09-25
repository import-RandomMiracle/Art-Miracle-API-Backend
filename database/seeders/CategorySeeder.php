<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Cinematography', 'Computer-generated imagery',
            'Digital image', 'Fine-art photography',
            'Graphics', 'Image editing',
            'Imaging', 'Photograph',
            'Satellite image', 'Drawing',
            'Painting', 'Visual arts','Other'];

        foreach ($categories as $category_name) {
            $category = new Category();
            $category->category_name = $category_name;
            $category->save();
        }

        $artworks = Artwork::get();
        $artworks->each(function($artwork, $key) {
            $n = fake()->numberBetween(1, 2);
            $category_ids = Category::inRandomOrder()->limit($n)->get()->pluck(['id'])->all();
            $artwork->categories()->sync($category_ids);
        });
    }
}
