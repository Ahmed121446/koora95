<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\CompetitionType;


use App\Country;


class CompetitionSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $competitions = [
    		'Egyptian League','Egyptian cup',
            'Premiere League','La Liga',
            'Bundesliga', 'SeriaA'
    	];

    	for ($i=0; $i < count($competitions); $i++) { 
	      	DB::table('competitions')->insert([
		       	'name' => $competitions[$i],
		       	'comp_type_id' => 1,
                'location_id' => Country::all()->random()->id,
                'location_type' => 'App\Country'
	       ]);
    	}
    }
}
