<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //Main seeders
        
        $country = App\Models\Country::firstOrCreate(['name' => 'България']);
        $city = App\Models\City::firstOrCreate(['name' => 'Враца','country_id' => '1']);

        App\Models\Purpose::insert([
       		[
        	'description'=>'profile',
    		],

       		[
        	'description'=>'logo',
    		],

       		[
        	'description'=>'front',
    		],

    		       		[
        	'description'=>'gallery',
    		],
        ]);   

        App\Models\Category::insert([
       		[
        	'name'=>'sport',
        	'description' => 'Lorem Ipsum',
    		],

       		[
        	'name'=>'education',
        	'description' => 'Lorem Ipsum',
    		],

       		[
        	'name'=>'entertainment',
        	'description' => 'Lorem Ipsum',
    		],

    		[
        	'name'=>'dance',
        	'description' => 'Lorem Ipsum',
    		],

    		[
        	'name'=>'art',
        	'description' => 'Lorem Ipsum',
    		],
        ]); 

        App\Models\Role::insert([
            
       		[
        	'role'=>'admin',
    		],

       		[
        	'role'=>'moderator',
    		],

    		[
        	'role'=>'organization_manager',
    		],

    		[
        	'role'=>'organization_member',
    		],
        ]);     

        $this->call([
        	OrganizationsTableSeeder::class,
        	ActivitiesTableSeeder::class,
        	UsersTableSeeder::class,
        	GroupsTableSeeder::class,
        	SchedulesTableSeeder::class,
            SubcategoryTableSeeder::class,
            SubscriptionsTableSeeder::class,
            NewslettersTableSeeder::class,
            NewsTableSeeder::class
   		 ]);

    }
}
