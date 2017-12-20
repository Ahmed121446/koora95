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
})->name('home');


Route::group(['prefix' => 'admin'], function() {
	Route::get('Login','AuthController@Login_View');
	Route::get('Register','AuthController@Register_View');

	Route::post('Login','AuthController@Login');
	Route::post('Register','AuthController@Register');
	Route::get('Logout','AuthController@Logout');
});

Route::group(['prefix' => 'country'], function() {	
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

Route::group(['prefix' => 'teams'], function() {	
	Route::get('create','TeamsController@Create_View');
});

Route::group(['prefix' => 'players'], function() {	
	Route::get('create','PlayersController@Create_View');
});