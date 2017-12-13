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
    	$rounds = ['First round','64','32','16','8','4','Final'];
         for ($i=0; $i < count($rounds) ; $i++) { 
        	DB::table('rounds')->insert([
        		'name' => $rounds[$i]
        	]);
        }
    }
}
