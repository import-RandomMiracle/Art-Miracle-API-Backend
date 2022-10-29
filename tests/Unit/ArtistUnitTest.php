<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Artwork;

class Artist extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testArtistHasManyArtworks()
    {
        $artist = new Artist();
        $artist->name = 'John Doe';
            
        $artwork = Artwork::factory()->create(['artist_id' => $artist->id]);
        $this->assertEquals($artist->artworks->first()->id, $artwork->id);
    }
}
