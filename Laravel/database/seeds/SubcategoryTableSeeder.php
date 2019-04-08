<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        $faker = Faker::create();
        foreach($categories as $category){
    		for($i = 0; $i < mt_rand(0,5); $i++) {
        		Subcategory::create([
        			'name' => $faker->company,
            		'description' => $faker->paragraph,
           			'category_id' => $category->category_id,
        		]);  
        	}  
    	}
    }
}
