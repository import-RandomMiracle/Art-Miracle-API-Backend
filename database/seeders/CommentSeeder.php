<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artworks = Artwork::get();
        $users = User::get();

        Comment::factory(100)->create();
    }
}
