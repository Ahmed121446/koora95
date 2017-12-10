<?php

use Illuminate\Database\Seeder;

class RoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$rounds = ['First round','Round of 64','Round of 32','Round of 16','Round of 8','Round of 4','Final'];
         for ($i=0; $i < count($rounds) ; $i++) { 
        	DB::table('rounds')->insert([
        		'name' => $rounds[$i]
        	]);
        }
    }
}
