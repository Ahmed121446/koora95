<?php

use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=1; $i <= 38 ; $i++) { 
        	DB::table('stages')->insert([
        		'season_id' => 9,
        		'stage_id' => $i,
        		'stage_type' => 'App\Week'
        	]);
        }
        
        for ($i=1; $i <= 7 ; $i++) { 
        	DB::table('stages')->insert([
        		'season_id' => 10,
        		'stage_id' => $i,
        		'stage_type' => 'App\Round'
        	]);
        }
    }
}
