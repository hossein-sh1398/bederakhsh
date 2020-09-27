<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Stage;

class StageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function htest_create()
    {
        $this->withoutExceptionHandling();

        $this->post('/admin/stage', [
            'name'        => 'new stage',
            'description' => 'descriptiondescriptiondescriptiondescriptiondescription',
            'count'       => 2,
            'start_date'  => '1399/07/03',
            'end_date'    => '1399/07/10',
            'vote_date'   => '1399/07/05',
            'status'      => 'pubished',
            'period_id'   => 1
        ]);

        
        $this->assertEquals('new stage', Stage::get()->last()->name);
    }

    public function test_update_stage()
    {
        $this->withoutExceptionHandling();

        $this->post('/admin/stage', [
            'name'        => 'new stage',
            'description' => 'descriptiondescriptiondescriptiondescriptiondescription',
            'count'       => 2,
            'start_date'  => '1399/07/03',
            'end_date'    => '1399/07/10',
            'vote_date'   => '1399/07/05',
            'status'      => 'pubished',
            'period_id'   => 1
        ]);

        $this->assertEquals('new stage', Stage::get()->last()->name);
        
        $stage = Stage::get()->last();

        $this->patch('admin/stage/'. $stage->id, [
            'name'        => 'Hossein',
            'description' => 'shirinegad',
            'count'       => 3,
            'start_date'  => '1399/07/04',
            'end_date'    => '1399/07/14',
            'vote_date'   => '1399/07/04',
            'status'      => 'trashed',
            'period_id'   => 1
        ]);

        $this->assertEquals('shirinegad', Stage::get()->last()->description);
    }
}
