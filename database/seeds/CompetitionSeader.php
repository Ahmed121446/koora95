<?php

use Illuminate\Database\Seeder;
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
        $competitions = [
    		'Egyptian League','Premiere League','La Liga','Bundesliga', 'SeriaA'
    	];
    	for ($i=0; $i < count($competitions); $i++) { 
	      	DB::table('competitions')->insert([
		       	'name' => $competitions[$i],
		       	'comp_type_id' => CompetitionType::all()->random()->id,
		       	'comp_scope_id' => 1
	       ]);
    	}
    }
}
