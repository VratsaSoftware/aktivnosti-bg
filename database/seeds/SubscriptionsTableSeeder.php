<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Subscription;
;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i = 0; $i < 200; $i++) {
        		Subscription::create([
        			'name' => $faker->firstName,
            		'email' => $faker->email,
           			'unsubscribed_global' => $faker->boolean($chanceOfGettingTrue = 20),
        		]);  
        	}  
    }
}
