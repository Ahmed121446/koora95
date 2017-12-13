<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Stage;

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
    	$Stage = Stage::all()->first();
    	

    	
    		for ($i=0; $i < count($Groups); $i++) { 
	    		DB::table('groups')->insert([
	    			'name' => $Groups[$i],
	    			'stage_id' => $Stage->id
	    		]);
    		}
    	
        
    }
}
