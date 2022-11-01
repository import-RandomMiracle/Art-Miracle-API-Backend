<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentHttpRequestFeatureTest extends TestCase
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

    public function testCommentIndex(){
        $response = $this->get('/api/comments');
        $response->assertStatus(200);
    }

    public function testCommentStore(){
        $response = $this->postJson('/api/comments', [
            'user_id'       => 1,
            'artwork_id'    => 1,
            'comment'       => 'comment1'
        ]);
        $response->assertStatus(201);
    }

    public function testCommentShow(){
        $response = $this->get('/api/comments/1');
        $response->assertStatus(200);
    }

    public function testCommentUpdate(){
        $response = $this->putJson('/api/comments/1', [
            'user_id'       => 1,
            'artwork_id'    => 1,
            'comment'       => 'comment1'
        ]);
        $response->assertStatus(200);
    }

    public function testCommentDestroy(){
        $response = $this->deleteJson('/api/comments/1');
        $response->assertStatus(404);
    }
}
