<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Organization;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$purpose = App\Models\Purpose::firstOrCreate(['description' => 'profile']);
        $organizations_array = Organization::where('organization_id' ,'>' ,0)->pluck('organization_id')->toArray(); 
        $faker = Faker::create();
    		for($i = 0; $i < 50; $i++) {
    			$approved = $faker->boolean($chanceOfGettingTrue = 50) ? date('Y-m-d H:i:s') : NULL;
    			$approved_by = $approved ? 'DBseeder' : NULL;
                $organization = $organizations_array[array_rand($organizations_array)];

        		$user = User::create([
            		'name' => $faker->firstName,
            		'family' => $faker->lastName,
            		'password' => Hash::make($faker->password),
            		'email' => $faker->email,
            		'address' => $faker->streetAddress,
            		'phone' => $faker->e164PhoneNumber,
            		'role_id' => mt_rand(1,4),
            		'city_id' => '1',
            		'approved_at' => $approved,
            		'approved_by' => 'seeder',
        		]);

        		$user->photo()->create([
           			'image_path' => 'avatar.jpeg',
           			'alt' => $faker->word,
           			'description' => $faker->sentence,
           			'purpose_id' => $purpose->purpose_id,
        		]);    

                if($user->role_id != 1 && $user->role_id){
                    $user->organizations()->attach($organization);
                }
        	}
    }
}
