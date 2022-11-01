<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArtworkHttpRequestFeatureTest extends TestCase
{   
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function testArtworkIndex(){
        $response = $this->get('/api/artworks');
        $response->assertStatus(200);
    }

    public function testArtworkStore(){
        $response = $this->postJson('/api/artworks', [
            'artist_id'     => 1,
            'art_name'      => 'Artwork 1',
            'path'          => 'path/to/artwork',
            'price'         => 1000,
            'description'   => 'This is a description',
            'categories'    => [1, 2],
            'tags'          => [1, 2]
        ]);
        $response->assertStatus(201);
    }

    public function testArtworkDestroy(){
        $response = $this->deleteJson('/api/artworks/1');
        $response->assertStatus(404);
    }

    public function testArtworkShow(){
        $response = $this->get('/api/artworks/1');
        $response->assertStatus(404);
    }

    public function testArtworkUpdate(){
        $response = $this->putJson('/api/artworks/1', [
            'artist_id'     => 1,
            'art_name'      => 'Artwork 1',
            'path'          => 'path/to/artwork',
            'price'         => 1000,
            'description'   => 'This is a description',
            'categories'    => [1, 2],
            'tags'          => [1, 2]
        ]);
        $response->assertStatus(404);
    }
}
