<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0;$i <= 60; $i++){
            $like = New Like();
            $like->artwork_id = Artwork::inRandomOrder()->first()->id;
            $like->user_id = User::inRandomOrder()->first()->id;
            $like->save();
        }
    }
}
