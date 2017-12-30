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
        remove from the database all the recordes in table continents
    	DB::table('continents')->truncate();
        // run  ContinentSeeder seeder 
        $this->call(ContinentSeeder::class);

        //remove from the database all the recordes in table countries
        DB::table('countries')->truncate();
        // run  CountrySeeder seeder 
        $this->call(CountrySeeder::class);


         //remove from the database all the recordes in table competition_types
        // DB::table('competition_types')->truncate();
        // // run  competition_types_Seeder seeder 
        // $this->call(competition_types_Seeder::class);


         //remove from the database all the recordes in table competition_scopes
     //    DB::table('competitions')->truncate();
     //    // run  CompetitionSeader seeder 
     //    // $this->call(CompetitionSeader::class);
       

     //    //remove from the database all the recordes in table seasons
     //    DB::table('seasons')->truncate();
     //    // run  SeasonSeeder seeder 
     //    // $this->call(SeasonSeeder::class);


     // //    // // should put TeamSeeder here ------------------------
        
        
     //    //remove from the database all the recordes in table team
     //    DB::table('teams')->truncate();
     //    // run  Registered_Team_Seeder seeder 
     //    // $this->call(TeamSeeder::class);
        
        
    
     //    //remove from the database all the recordes in table registered_teams
     //    DB::table('registered_teams')->truncate();
     //    // run  Registered_Team_Seeder seeder 
     //    // $this->call(Registered_Team_Seeder::class);


     //    //remove from the database all the recordes in table players
     //    DB::table('players')->truncate();
     //    // run  PlayerSeeder seeder 
     //    // $this->call(PlayerSeeder::class);

     //    //remove from the database all the recordes in table registered_players
     //    DB::table('registered_players')->truncate();
     //    // run  RegisterPlayersSeeder seeder 
     //    // $this->call(RegisterPlayersSeeder::class);



     //    DB::table('stages')->truncate();
     //    // run  RoundSeeder seeder 
        // $this->call(StageSeeder::class); 


        
    }
}
