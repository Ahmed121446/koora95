<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class competition_scopes_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scopes = [
    		'Local','Continental','Global',
    	];
        for ($i=0; $i < count($scopes); $i++) { 
        	DB::table('competition_scopes')->insert([
        		'name' => $scopes[$i],
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	]);
        }
    }
}
