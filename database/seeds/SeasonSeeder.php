<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\competition;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$Seasons = [
    		'2009','2010','2011','2012',
    		'2013','2014','2015','2016',
    		'2017'
    	];
        $faker = Faker::create();
        for ($i=0; $i < count($Seasons); $i++) { 
        	DB::table('seasons')->insert([
        		'name' => $Seasons[$i],

                'comp_id' => 1,
                'active' => 0,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	]);
        }
    }
}
