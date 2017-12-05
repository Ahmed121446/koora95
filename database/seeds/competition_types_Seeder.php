<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class competition_types_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scopes = [
    		'League','Cup'
    	];
        for ($i=0; $i < count($scopes); $i++) { 
        	DB::table('competition_types')->insert([
        		'name' => $scopes[$i],
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	]);
        }
    }
}
