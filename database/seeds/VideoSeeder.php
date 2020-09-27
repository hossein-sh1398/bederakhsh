<?php

use Illuminate\Database\Seeder;
use App\Campaign;
use App\Video;
use Carbon\Carbon;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Video::truncate();

        foreach (Campaign::get() as $key => $Campaign) {
        	//$t = time() - (($key + 1 ) * (24 * 3600));
        	factory(Video::class, 2)->create([
        		'campaign_id' => $Campaign->id,
        		'created_at' => Carbon::now()->subDays($key), //date('Y/m/d H:i:s', $t),
        		'updated_at' => Carbon::now()->subDays($key), //date('Y/m/d H:i:s', $t)
        	]);
         } 

    }
}
