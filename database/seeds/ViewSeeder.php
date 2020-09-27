<?php

use Illuminate\Database\Seeder;
use App\User;
use App\View;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = User::with('campaign')->limit(10)->get();
    	$users->each(function($user){
    		factory(View::class)->create([
    			'viewable_id' => $user->campaign->id,
    			'viewable_type' => get_class($user->campaign)
    		]);
    	});
       
    }
}
