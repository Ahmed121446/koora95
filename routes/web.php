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
	Route::get('Login','AuthController@Login_View')->name('login');
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
		Route::get('{season}/groups/create','SeasonController@createGroups');
		Route::post('{season}/stages/create','SeasonController@addStage');

		Route::group(['prefix' => '{season}/groups'], function() {
			Route::get('/', 'GroupController@showGroups');
			Route::get('/create','GroupController@createGroupsView');
			Route::post('/create','GroupController@addGroups');
			Route::get('/{stage}/teams/create', 'GroupController@addTeamsView');
			Route::post('/{stage}/teams/create', 'GroupController@addGroupTeams');
		});

		Route::group(['prefix' => '{season}/teams'], function() {
		 	Route::get('{team}','RegisteredTeamsController@show');
		 	Route::post('create', 'RegisteredTeamsController@addTeams');

		 	Route::group(['prefix' => '/{team}/players'], function() {
				Route::post('create','RegisteredPlayersController@add');
			});
		});

		Route::group(['prefix' => '/{season}/stages'], function() {
			// Route::post('create','SeasonController@addStages');
		});
	});

});

Route::group(['prefix' => 'teams'], function() {	
	Route::get('/','TeamsController@All_Teams');
	Route::get('create','TeamsController@Create_View');
	Route::post('create','TeamsController@create');
	Route::get('/{id}','TeamsController@remove_team');
	Route::post('/update/{team_id}','TeamsController@update');
});

Route::group(['prefix' => 'players'], function() {	
	Route::get('/','PlayersController@All_Players');
	Route::get('create','PlayersController@Create_View');
	Route::post('create','PlayersController@create');
	Route::get('{team}/search','PlayersController@autocomplete');
	Route::get('/search','PlayersController@autocomplete');
	Route::get('/{id}','PlayersController@remove_player');
	Route::post('/update/{player_id}','PlayersController@update');

});

Route::get('/stages', 'SeasonController@allStages');
Route::get('/stages/rounds', 'SeasonController@findStageRounds');
Route::get('/stages/data', 'SeasonController@findStageData');



Route::group(['prefix' => 'matches'], function() {
	Route::get('/add-match','MatchesController@Add_Match_View');
	Route::get('/','MatchesController@ALL_matches_View');
	Route::get('/teams','MatchesController@getTeams');
	Route::get('/{match}', 'MatchesController@Get_S_Match' );


	Route::post('/create','MatchesController@Create');

	Route::post('/update/{id}','MatchesController@update_match');

	Route::get('/delete/{id}','MatchesController@remove_match');

	Route::post('/live/update/{match}','MatchesController@updateLive');
	Route::get('/status/update/{match}','MatchesController@updateStatus');
});
