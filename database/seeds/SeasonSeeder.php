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
    		'1993','1994','1995','1996',
    		'1997','1998','1999','2000',
    		'2001','2002','2003','2004',
    		'2005','2006','2007','2008',
    		'2009','2010','2011','2012',
    		'2013','2014','2015','2016',
    		'2017'
    	];
        $faker = Faker::create();
        for ($i=0; $i < count($Seasons); $i++) { 
        	DB::table('seasons')->insert([
        		'name' => $Seasons[$i],
                'active' => $faker->boolean,
                'competition_id' => competition::all()->random()->id,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	]);
        }
    }
}
