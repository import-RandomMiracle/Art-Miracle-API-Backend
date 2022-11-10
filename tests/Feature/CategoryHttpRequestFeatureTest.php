<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryHttpRequestFeatureTest extends TestCase
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

    public function testCategoryIndex(){
        $response = $this->get('/api/categories');
        $response->assertStatus(200);
    }

    public function testCategoryStore(){
        $response = $this->postJson('/api/categories', [
            'category_name'      => 'category1',
        ]);
        $response->assertStatus(201);
    }

    public function testCategoryShow(){
        $response = $this->get('/api/categories/2');
        $response->assertStatus(200);
    }

    public function testCategoryDestroy(){
        $response = $this->deleteJson('/api/categories/1');
        $response->assertStatus(404);
    }

}
