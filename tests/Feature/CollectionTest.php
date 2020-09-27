<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CollectionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_sort()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->get('/sort');

        $response->assertStatus(200);
    }
}
