<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TeamSeeder extends Seeder
{
    /**
     *  $table->string('name');
            $table->integer('type_id');
            $table->text('logo');
            $table->integer('stadium');
            $table->integer('country_id');
            $table->timestamps();
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create(); 
        for ($i=0; $i < 10 ; $i++) { 
    		 DB::table('teams')->insert([

	        	'name' => $faker->name,
	        	'type_id' => 1,
                'logo' => "logo.png",
                'stadium' => "ahly club",
                'country_id' => 1,
       		 ]);
    	}
    }
}
