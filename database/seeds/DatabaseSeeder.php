<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	// \Schema::disableForeignKeyConstraints();
        $this->call(UserSeeder::class);
        $this->call(CampaignTableSeeder::class);
    	// \Schema::enableForeignKeyConstraints();

    	// برای این که فقط یک سیدر به خصوص اجرا بشه
    	// php artisan db:seed --class UserTableSeedr
    }
}
