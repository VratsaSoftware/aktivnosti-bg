<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Organization;


class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
    	
    	$purpose = App\Models\Purpose::firstOrCreate(['description' => 'profile']);
        $faker = Faker::create();
    		for($i = 0; $i < 100; $i++) {
        		$organization = Organization::create([
            		'name' => $faker->company,
            		'description' => $faker->paragraph,
            		'email' => $faker->email,
            		'address' => $faker->streetAddress,
            		'phone' => $faker->e164PhoneNumber,
            		'city_id' => '1',
        		]);    

        		$organization->photos()->create([
           			'image_path' => '/user_files/images/profile/logo.png',
           			'alt' => $faker->word,
           			'description' => $faker->sentence,
           			'purpose_id' => $purpose->purpose_id,
        		]);
    		}
    }
}
