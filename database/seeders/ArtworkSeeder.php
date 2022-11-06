<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;

class ArtworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artwork::factory(10)->create([
            'artist_id' => function () {
                $artist_ids = Artist::select(['id'])->get();
                return Artist::inRandomOrder()->first()->id;
            },
            'image_id' => function () {
                return Image::factory()->create()->id;
            },
        ]);

        $users = User::get();
        $users->each(function ($user, $key) {
            $n = fake()->numberBetween(1, 5);
            $artwork_ids = Artwork::inRandomOrder()->limit($n)->get()->pluck(['id'])->all();
            $user->artworks()->sync($artwork_ids);
        });
    }
}
