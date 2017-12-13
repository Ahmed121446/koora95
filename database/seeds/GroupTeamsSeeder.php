<?php

use Illuminate\Database\Seeder;

use App\Group;
use App\RegisteredTeam;
use Carbon\Carbon;
class GroupTeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=0; $i < 6; $i++) { 
    		 DB::table('group__teams')->insert([
	        	'group_id' => Group::all()->random()->id,
	        	'register_team_id' => RegisteredTeam::all()->random()->id,
	        	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	]);
    	}
       
    }
}
