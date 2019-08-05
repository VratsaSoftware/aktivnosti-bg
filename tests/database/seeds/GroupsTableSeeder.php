<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Group;
use App\Models\Activity;
use App\Models\User;


class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = User::all();
    	$activities = Activity::all();
        $member;
        $user_id;
        foreach($activities as $activity){
            $organization_id = $activity->organization->organization_id;
            foreach($users as $user){
                if(isset($user->organizations->first()->organization_id)){
                    $user_organization = $user->organizations->first()->organization_id;
                    if( $user_organization == $organization_id){
                        $user_id=$user->user_id;
                        break;
                    }
                }
            }
        	$faker = Faker::create();
    		for($i = 0; $i < 3; $i++){
        		$group = Group::create([
            			'name' => $faker->company,
            			'description' => $faker->paragraph,
            			'activity_id' => $activity->activity_id,
            			'user_id' => isset($user_id) ? $user_id : NULL,

        			]);    	
        	}		
       	}	
    }
}
