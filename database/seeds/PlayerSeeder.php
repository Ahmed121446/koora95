<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Team;


class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$positions = [
    		'WF','CF','SS',
    		'CM','DM','AM','WM',
    		'LB','LWB','CB','SW','RB','RWB',
    		'GK'
    	];
        $faker = Faker::create();
        for ($i=0; $i < 100; $i++) { 

        	$k = array_rand($positions);
			$v = $positions[$k];

        	DB::table('players')->insert([
        		'name' => $faker->name,
        		'position' => $v,
                'team_id' => Team::all()->random()->id,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	]);
        }
    }
}
