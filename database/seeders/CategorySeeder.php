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
        $categories = ['Image', 'Model'];

        foreach ($categories as $category_name) {
            $category = new Category();
            $category->category_name = $category_name;
            $category->save();
        }
    }
}
