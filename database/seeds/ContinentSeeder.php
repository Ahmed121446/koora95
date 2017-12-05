<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ContinentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$World_continents = [
    		'Africa','Asia','Europe','North America','Australia','South America'
    	];
    	for ($i=0; $i < count($World_continents); $i++) { 
	      	DB::table('continents')->insert([
		       	'name' => $World_continents[$i],
		       	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	       ]);
    	}
     
    }
}
