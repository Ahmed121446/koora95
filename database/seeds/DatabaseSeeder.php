<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //remove from the database all the recordes in table continents
    	//DB::table('continents')->truncate();
        // run  ContinentSeeder seeder 
       // $this->call(ContinentSeeder::class);


        //remove from the database all the recordes in table countries
        //DB::table('countries')->truncate();
        // run  CountrySeeder seeder 
       // $this->call(CountrySeeder::class);

        //remove from the database all the recordes in table countries
        //DB::table('players')->truncate();
        // run  CountrySeeder seeder 
        //$this->call(PlayerSeeder::class);

        
    }
}
