<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Season;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$Groups =['A','B','C','D'];
    	$seasons = Season::all();
    	$season_count = count($seasons);

    	foreach ($seasons as $season) {
    		for ($i=0; $i < count($Groups); $i++) { 
	    		DB::table('groups')->insert([
	    			'name' => $Groups[$i],
	    			'season_id' => $season->id
	    		]);
    		}
    	}
    	
        
    }
}
