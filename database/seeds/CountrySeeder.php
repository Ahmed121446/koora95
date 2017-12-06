<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

use App\continent;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$faker = Faker::create();
        for ($i=0; $i < 10; $i++) { 

        	DB::table('countries')->insert([
        		'name' => $faker->country,
        		'continent_id' => continent::all()->random()->id,
        		'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        	]);
        }
    }
}
