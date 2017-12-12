<?php

use Illuminate\Database\Seeder;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 100 ; $i++) { 
        	DB::table('weeks')->insert([
        		'number' => $i
        	]);
        }
    }
}
