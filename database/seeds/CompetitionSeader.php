<?php

use Illuminate\Database\Seeder;
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
        $competitions = [
    		'Egyptian League','Egyptian cup',
            'Premiere League','La Liga',
            'Bundesliga', 'SeriaA'
    	];
    	for ($i=0; $i < count($competitions); $i++) { 
	      	DB::table('competitions')->insert([
		       	'name' => $competitions[$i],
		       	'comp_type_id' => 1,
		       	'comp_scope_id' => 1,
                'country_id' => Country::all()->random()->id

	       ]);
    	}
    }
}
