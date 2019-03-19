<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Activity;

class ActivitiesTableSeeder extends Seeder
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
    			$min_age = rand(3,20);
        		$activity = Activity::create([
            		'name' => $faker->company,
            		'description' => $faker->paragraph,
            		'min_age' => $min_age,
            		'max_age' => $min_age+(rand(3,20)),
            		'price' => rand(0,300),
            		'start_date' => $faker->date($format = 'Y-m-d'),
            		'requirements' => $faker->word,
            		'available' => $faker->boolean($chanceOfGettingTrue = 50),
            		'fixed_start' => $faker->boolean($chanceOfGettingTrue = 50),
            		'latitude'=>$faker->latitude($min = 41, $max = 43),
            		'longitude'=>$faker->longitude($min = 22, $max = 23),
            		'address' => $faker->streetAddress,
            		'city_id' => '1',
            		'category_id' => mt_rand(1,5),
            		'organization_id' => mt_rand(1,100),

        		]);    

        		$activity->photos()->create([
           			'image_path' => '/user_files/images/profile/logo.png',
           			'alt' => $faker->word,
           			'description' => $faker->sentence,
           			'purpose_id' => mt_rand(2,4),
        		]);

        	}
    }
}


