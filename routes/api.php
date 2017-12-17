<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'competitions'], function() {
	Route::get('/', 'CompetitionsController@findAll');
	Route::post('/', 'CompetitionsController@create');
	Route::get('/{competition}', 'CompetitionsController@findById');
	Route::put('/update/{competition}', 'CompetitionsController@update');
	Route::delete('/delete/{competition}', 'CompetitionsController@delete');
});


Route::group(['prefix' => 'Continent'], function() {
	Route::get('All-Continent','ContinentController@Get_All_Continents');
	Route::get('{id}','ContinentController@Get_Continent');
});


Route::group(['prefix' => 'Country'], function() {
	//get request to retrive all countries
	Route::get('All-countries','CountryController@Get_All_Countries');
    //get request to render the create.blade.php   [[  create new country form   ]]
	Route::get('Create','CountryController@Get_Country_Create_View');
    //get request to render the update.blade.php   [[  update country form   ]]
	Route::get('Update/{id}','CountryController@Get_Country_Update_View');
    //get request to retrive specific country
	Route::get('{id}','CountryController@Get_Country');
	//post request for create new country
	Route::post('Create','CountryController@Create_Country');
	//put request for update country and it will take id
	Route::put('Update/{id}','CountryController@Update_Country');
	// delete request for deleting country it will take id
	Route::delete('{id}','CountryController@destroy');
});


Route::group(['prefix' => 'Seasons'], function() {

	Route::get('Season/{season}/Stage','SeasonController@Season_Stages');

	//get request to retrive all Seasons
	Route::get('All-Seasons', 'SeasonController@Get_All_Seasons');
	//get request to render the create.blade.php   [[  create new Season form   ]]
	Route::get('Create', 'SeasonController@Get_Create_View_Seasons');
	//get request to render the update.blade.php   [[  update Season form   ]]
	Route::get('Update/{id}', 'SeasonController@Get_Update_View_Seasons');
	//get request to retrive specific Seasons
	Route::get('{id}', 'SeasonController@Get_Season');
	//post request for create new Season
	Route::post('Create', 'SeasonController@Add_Season');
	//put request for update Season and it will take id
	Route::put('Update/{id}', 'SeasonController@Update_Season');
	// delete request for deleting Season it will take id
	Route::delete('Delete/{id}', 'SeasonController@Destroy_Season');


	//handle Registered Teams routes through season rote
	Route::group(['prefix' => '{season}/RegisteredTeam'], function() {
		//find all Registered teams
		Route::get('teams', 'RegisteredTeamsController@findAll');
		//create new  Registered team
		Route::post('teams', 'RegisteredTeamsController@create');
		//find Registered team by  Registered team id
		Route::get('{team_id}', 'RegisteredTeamsController@findById');
		//update Registered team by its id
		Route::put('update-team/{team_id}', 'RegisteredTeamsController@update');
		//delete Registered team by its id
		Route::delete('delete-team/{team_id}', 'RegisteredTeamsController@delete');

		//handle Registered Players routes through Seasons/{season}/RegisteredTeam/{team}/RegisteredPlayer
		Route::group(['prefix' => '{team}/RegisteredPlayer'], function(){
			//find all Registered players in Registered team
			Route::get('players', 'RegisteredPlayersController@findAll');
			//find Registered player in Registered team
			Route::get('{player}', 'RegisteredPlayersController@findById');
			//create new  Registered player
			Route::post('Create', 'RegisteredPlayersController@Add_Player_In_RegisteredTeam');
			//update Registered player by its id
			Route::put('{player}/update', 'RegisteredPlayersController@Update_Player_From_RegisteredTeam');
			//delete Registered player by its id
			Route::delete('{player}', 'RegisteredPlayersController@Delete_Player_From_RegisteredTeam');
		});
	});

	// Handling Matches through a Season
	Route::group(['prefix' => '{season}/Event'], function() {
		Route::get('/matches/InProgress', 'MatchesController@Matches_InProgressed_state');
		Route::get('/matches', 'MatchesController@getSeasonMatches');
		Route::post('/matches', 'MatchesController@addMatch');
			//find matches by date
		Route::get('/matches/{date}', 'MatchesController@Find_Date');
			// find matches by stage
		Route::get('/matches/stage/{stage_id}', 'MatchesController@findByStage');
			//find matches for this team 
		Route::get('/{team}/matches', 'MatchesController@Find_Team_Matches');
			//update match
		Route::put('/update-match/{match}', 'MatchesController@update');
			//delete match
		Route::delete('/delete-match/{match}', 'MatchesController@delete');
			// confirm match result
		Route::post('/matches/{match}/confirm', 'MatchesController@confirmResult');
	});

	


	// Handling groups through a Season
	Route::get('/{season}/groups', 'GroupController@findAllGroups');
	Route::get('/{season}/{group}', 'GroupController@findOne');
	Route::get('/{season}/Group/{group}/Delete', 'GroupController@delete');
	
	// Route::get('/{season}/stage/{stage}/groups', 'GroupController@createGroups');
	Route::post('/{season}/stage/{stage}/groups', 'GroupController@createGroups');
	Route::post('/{season}/stages/groups/{group}/teams', 'GroupController@addTeams');

	// Group Teams
	Route::group(['prefix' => 'Groups'], function() {
		//get all teams in Specific group
		Route::get('Season/{season}/group/{group}/teams','GroupTeamsController@get_All_Teams_In_Specific_Group');
	    //get Specific team in Specific group
		Route::get('Season/{season}/group/{group}/team/{team}','GroupTeamsController@get_Team_In_Specific_Group');
	    //add new team in Specific group
		Route::post('Season/{season}/group/{group}/add-team', 'GroupTeamsController@Add_Team_In_Group');
	    //delete Specific team in Specific group
		Route::delete('Season/{season}/group/{group}/delete-team/{team}', 'GroupTeamsController@Delete_Team_From_Group');
	});



});

Route::group(['prefix' => 'Teams'], function() {
	//get request to retrive all Teams
	Route::get('All-Teams', 'TeamsController@Get_All_Teams');
	//get request to render the create.blade.php   [[  create new Team form   ]]
	Route::get('Create', 'TeamsController@Get_Create_View_Teams');
	//get request to render the update.blade.php   [[  update Team form   ]]
	Route::get('Update/{id}', 'TeamsController@Get_Update_View_Teams');
	//get request to retrive specific Seasons
	Route::get('{id}', 'TeamsController@Get_Team');

	//post request for create new Team
	Route::post('Create', 'TeamsController@Create_Team');
	//put request for update Team and it will take id
	Route::put('Update/{id}', 'TeamsController@Update_Team');
	// delete request for deleting Team it will take id
	Route::delete('Delete/{id}', 'TeamsController@Destroy_Team');
});
Route::group(['prefix' => 'Players'], function() {
	//get request to render the create.blade.php   [[  create new player form   ]]
	Route::get('Create','PlayersController@Get_Player_Create_View');
    //get request to render the update.blade.php   [[  update player form   ]]
	Route::get('Update/{id}','PlayersController@Get_Player_Update_View');
    //get request to retrive all Players
	Route::get('All-Players','PlayersController@Get_All_Players');
	
	//get request to retrive specific Players
	Route::get('{id}','PlayersController@Get_Player');
    //post request for create new country
	Route::post('Create','PlayersController@Create_Player');
	//put request for update country and it will take id
	Route::put('Update/{id}','PlayersController@Update_Player');
    // delete request for deleting country it will take id
	Route::delete('{id}','PlayersController@destroy');
});

Route::get('/matches/today', 'MatchesController@todayMatches');

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});