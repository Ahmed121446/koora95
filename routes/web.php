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

Route::group(['prefix' => 'competitions'], function() {
	Route::get('/','CompetitionsController@All_Competitions_View');
	Route::get('create','CompetitionsController@Create_View');
	Route::post('create','CompetitionsController@createCompetition');
	Route::get('{Competition}','CompetitionsController@Specific_Competition_View');

	Route::group(['prefix' => '{competition}/seasons'], function() {
		Route::get('/','SeasonController@All_Seasons_View');
		Route::post('create','SeasonController@create');
		Route::get('{season}','SeasonController@Specific_Season_View');

		Route::group(['prefix' => '{season}/teams'], function() {
		 	Route::get('{team}','RegisteredTeamsController@show');
		 	Route::post('create', 'RegisteredTeamsController@addTeams');

		 	Route::group(['prefix' => '/{team}/players'], function() {
		 		Route::get('/','RegisteredPlayersController@add_player');
				Route::post('create','RegisteredPlayersController@add');
			});
		 });
	});

});


Route::group(['prefix' => 'teams'], function() {	
	Route::get('create','TeamsController@Create_View');
	Route::post('create','TeamsController@create');
});

Route::group(['prefix' => 'players'], function() {	
	Route::get('create','PlayersController@Create_View');
	Route::post('create','PlayersController@create');
	Route::get('/search','PlayersController@autocomplete');
});
