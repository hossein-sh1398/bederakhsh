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
        $users = App\User::get();

        $users->each(function($user){
        	factory(App\Campaign::class)->create(['user_id' => $user->id]);
        });
    }
}
