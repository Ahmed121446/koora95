<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\CompetitionType;

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
    		'Egyptian League','Premiere League','La Liga','Bundesliga', 'SeriaA'
    	];

    	for ($i=0; $i < count($competitions); $i++) { 
	      	DB::table('competitions')->insert([
		       	'name' => $competitions[$i],
                'comp_type_id' => CompetitionType::all()->random()->id,
		       	'comp_scope_id' => 1,
                'country_id' => $faker->numberBetween($min = 1, $max = 100)
		       	
	       ]);
    	}
    }
}
