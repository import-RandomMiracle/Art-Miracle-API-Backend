<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create([
            'artist_id' => function () {
            if(random_int(0,1) == 1)
                return Artist::factory()->create()->id;
            else
                return null;
        },
        'wallet_id' => function () {
            return Wallet::factory()->create()->id;
        }]);
    }
}
