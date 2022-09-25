<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['original', 'girl', 'manga', 'Touhou', 'traditional',
            'doodle', 'creation', 'yaoi', 'Kancolle', 'Pokémon',
            'illustration', 'Kantai', 'Collection', 'hatsune miku', 'original',
            'character', 'young girl','breasts', 'doodle', 'The Idolmaster: Cinderella Girls',
            'hetalia', 'furry', 'swimsuit', 'virtual YouTuber', 'Touhou Project',
            'Touken Ranbu', 'original works', 'boy', 'large breasts', 'gijinka',
            'practice', 'love live!', 'yuri', 'incredibly cute', '4-koma',
            'Hololive', 'The Idolmaster', 'replica', 'scenery', 'Genshin Impact',
            'original', 'Demon Slayer:Kimetsu no Yaiba', 'ugoira', 'Puella Magi Madoka Magica'];

        foreach ($tags as $tag_name) {
            $tag = new Tag();
            $tag->tag_name = $tag_name;
            $tag->save();
        }

        $artworks = Artwork::get();
        $artworks->each(function($artwork, $key) {
            $n = fake()->numberBetween(1, 5);
            $tag_ids = Tag::inRandomOrder()->limit($n)->get()->pluck(['id'])->all();
            $artwork->tags()->sync($tag_ids);
        });
    }
}
