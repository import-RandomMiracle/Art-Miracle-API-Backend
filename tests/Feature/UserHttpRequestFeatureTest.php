<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserHttpRequestFeatureTest extends TestCase
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

    public function testUserIndex(){
        $response = $this->get('/api/users');
        $response->assertStatus(200);
    }
    
    public function testUserStore(){
        $response = $this->postJson('/api/users', [
            'user_name'      => 'user1',
            'password'      => 'password',
            'email'         => 'user1@example.com',
            'display_name'  => 'User 1'
        ]);
        $response->assertStatus(201);
    }

    public function testUserUpdate(){
        $response = $this->putJson('/api/users/1', [
            'user_name'      => 'user1',
            'password'      => 'password',
            'email'         => 'user1@example.com',
            'display_name'  => 'User 1'
        ]);
        $response->assertStatus(200);   
        }

}
