<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Group;
use App\Models\Schedule;


class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$groups = Group::all();
        $faker = Faker::create();
        foreach($groups as $group){
    		for($i = 0; $i < 2; $i++) {
        		$schedule = Schedule::create([
           			'day' => $faker->dayOfWeek,
           			'start_time' => $faker->time($format = 'H:i:s', $max = 'now'),
           			'end_time' => $faker->time($format = 'H:i:s', $min = 'now'),
           			'group_id' => $group->group_id,
        		]);  
        	}  
    	}
    }
}
