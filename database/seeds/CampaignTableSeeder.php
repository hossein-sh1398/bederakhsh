<?php

use Illuminate\Database\Seeder;

class CampaignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [13,14,15,16,17,18,18,21,21,50,51,52,53,54,55,56,57,58,59,60];
        collect($user)->each(function($id){
        	factory(App\Campaign::class)->create(['user_id' => $id]);
        });
    }
}
