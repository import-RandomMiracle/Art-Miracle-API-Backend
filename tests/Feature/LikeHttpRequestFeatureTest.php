<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeHttpRequestFeatureTest extends TestCase
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
    
    public function testLikeIndex(){
        $response = $this->get('/api/likes');
        $response->assertStatus(200);
    }

    public function testLikeStore(){
        $response = $this->postJson('/api/likes', [
            'user_id'       => 1,
            'artwork_id'    => 1
        ]);
        $response->assertStatus(201);
    }

    public function testLikeDestroy(){
        $response = $this->deleteJson('/api/likes/1');
        $response->assertStatus(404);
    }

}
