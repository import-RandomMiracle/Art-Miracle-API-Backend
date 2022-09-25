<?php

namespace Database\Seeders;

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
        Artwork::factory(30)->create();

        $users = User::get();
        $users->each(function($user, $key) {
            $n = fake()->numberBetween(1, 5);
            $artwork_ids = Artwork::inRandomOrder()->limit($n)->get()->pluck(['id'])->all();
            $user->artworks()->sync($artwork_ids);
        });
    }
}
