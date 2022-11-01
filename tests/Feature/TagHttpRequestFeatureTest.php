<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagHttpRequestFeatureTest extends TestCase
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

    public function testTagIndex(){
        $response = $this->get('/api/tags');
        $response->assertStatus(200);
    }

    public function testTagStore(){
        $response = $this->postJson('/api/tags', [
            'tag_name'      => 'tag1',
        ]);
        $response->assertStatus(201);
    }

    public function testTagShow(){
        $response = $this->get('/api/tags/1');
        $response->assertStatus(200);
    }

    public function testTagDestroy(){
        $response = $this->deleteJson('/api/tags/1');
        $response->assertStatus(404);
    }

}
