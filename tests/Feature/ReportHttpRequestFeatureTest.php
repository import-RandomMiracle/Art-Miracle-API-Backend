<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportHttpRequestFeatureTest extends TestCase
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

    public function testReportIndex(){
        $response = $this->get('/api/reports');
        $response->assertStatus(200);
    }

    public function testReportStore(){
        $response = $this->postJson('/api/reports', [
            'user_reported_id'  => 1,
            'reportable_id'     => 1,
            'reportable_type'   => 'App\Models\Artwork',
            'description'       => 'This is a test description'
        ]);
        $response->assertStatus(201);
    }

    public function testReportDestroy(){
        $response = $this->deleteJson('/api/reports/1');
        $response->assertStatus(404);
    }


}
