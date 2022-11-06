<?php

namespace Database\Seeders;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_count = User::count();

        for($i=0; $i < 1000; $i++){
            $follow = new Follow();
            $follow->followee_id = fake()->numberBetween(1,$user_count);
            $follow->follower_id = fake()->numberBetween(1,$user_count);
            $follow->save();
        }
    }
}
