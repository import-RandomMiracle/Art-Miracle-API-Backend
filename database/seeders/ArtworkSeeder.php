<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Artwork;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artist_ids = Artist::select(['id'])->get();
        Artwork::factory(30)->create([
            'artist_id' => $artist_ids->random()->id,
        ]);

        $users = User::get();
        $users->each(function ($user, $key) {
            $n = fake()->numberBetween(1, 5);
            $artwork_ids = Artwork::inRandomOrder()->limit($n)->get()->pluck(['id'])->all();
            $user->artworks()->sync($artwork_ids);
        });
    }
}
