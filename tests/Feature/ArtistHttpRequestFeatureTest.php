<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ArtistHttpRequestFeatureTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // public function setUp(): void
    // {
    //     parent::setUp();
    //     $this->seed();
    // }

    // public function tearDown(): void
    // {
    //     DB::table('artists')->truncate();
    //     parent::tearDown();
    // }

    
    public function testArtistIndex(){
        $response = $this->get('/api/artists');
        $response->assertStatus(200);
    }

    public function testArtistStore(){
        $response = $this->postJson('/api/artists', [
            'citizen_id'    => '1234567890123',
            'real_name'     => 'John Doe',
            'address'       => '1234 Street, City, Country'
        ]);
        $response->assertStatus(201);
    }

    public function testArtistDestroy(){
        $response = $this->deleteJson('/api/artists/1');
        $response->assertStatus(404);
    }

    public function testArtistShow(){
        $response = $this->get('/api/artists/1');
        $response->assertStatus(404);
    }

}
