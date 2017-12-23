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



Route::get('/', 'MatchesController@Get_Today_Matches_View' )->name('home');

Route::group(['prefix' => 'admin'], function() {
	Route::get('Login','AuthController@Login_View');
	Route::get('Register','AuthController@Register_View');

	Route::post('Login','AuthController@Login');
	Route::post('Register','AuthController@Register');
	Route::get('Logout','AuthController@Logout');
});

Route::group(['prefix' => 'competitions'], function() {
	Route::get('/','CompetitionsController@All_Competitions_View');
	Route::get('create','CompetitionsController@Create_View');
	Route::post('create','CompetitionsController@createCompetition');
	Route::get('{competition}','CompetitionsController@Specific_Competition_View');

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
	Route::get('/','TeamsController@All_Teams');
	Route::get('create','TeamsController@Create_View');
	Route::post('create','TeamsController@create');
	Route::get('/{id}','TeamsController@remove_team');
});

Route::group(['prefix' => 'players'], function() {	
	Route::get('/','PlayersController@All_Players');
	Route::get('create','PlayersController@Create_View');
	Route::post('create','PlayersController@create');
	Route::get('/search','PlayersController@autocomplete');
	Route::get('/{id}','PlayersController@remove_player');
});



Route::group(['prefix' => 'matches'], function() {
	Route::get('/add-match','MatchesController@Add_Match_View');
	Route::get('/','MatchesController@ALL_matches_View');
	Route::get('/test','MatchesController@test');


	Route::post('/create','MatchesController@Create');
	Route::get('/{id}','MatchesController@remove_match');
});
