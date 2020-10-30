<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CollectTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_collect()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/coll');

        //$response->assertStatus(200);
    }
}
