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
     //    //remove from the database all the recordes in table continents
    	// DB::table('continents')->truncate();
     //    // run  ContinentSeeder seeder 
     //    $this->call(ContinentSeeder::class);


     //    //remove from the database all the recordes in table countries
     //    DB::table('countries')->truncate();
     //    // run  CountrySeeder seeder 
     //    $this->call(CountrySeeder::class);

     //    //remove from the database all the recordes in table players
     //    DB::table('players')->truncate();
     //    // run  PlayerSeeder seeder 
     //    $this->call(PlayerSeeder::class);

     //    //remove from the database all the recordes in table seasons
     //    DB::table('seasons')->truncate();
     //    // run  SeasonSeeder seeder 
     //    $this->call(SeasonSeeder::class);



        //remove from the database all the recordes in table countries
        DB::table('competition_types')->truncate();
        // run  CountrySeeder seeder 
        $this->call(competition_types_Seeder::class);

          //remove from the database all the recordes in table countries
        DB::table('competition_scopes')->truncate();
        // run  CountrySeeder seeder 
        $this->call(competition_scopes_Seeder::class);

        
    }
}
