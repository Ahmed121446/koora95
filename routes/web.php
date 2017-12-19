<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'Competitions'], function() {
	Route::get('Create','CompetitionsController@Create_View');
	Route::get('All-Competitions','CompetitionsController@All_Competitions_View');
	Route::get('{Competition}','CompetitionsController@Specific_Competition_View');

	Route::group(['prefix' => '{Competition}/Season'], function() {
		 Route::get('{season}','SeasonController@Specific_Season_View');

		 Route::group(['prefix' => '{season}/RegisteredTeam'], function() {
		 	Route::get('{RegisteredTeam}','RegisteredTeamsController@Specific_RegisteredTeam_View');
		 });

	});
	
});
