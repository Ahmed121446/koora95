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
	Route::post('Create', 'SeasonController@Create_Season');
	//put request for update Season and it will take id
	Route::put('Update/{id}', 'SeasonController@Update_Season');
	// delete request for deleting Season it will take id
	Route::delete('Delete/{id}', 'SeasonController@Destroy_Season');



	// Handling Teams through a Season
	Route::get('/{season}/teams', 'RegisteredTeamsController@findAll');
	Route::post('/{season}/teams', 'RegisteredTeamsController@create');
	Route::get('/{season}/teams/{team_id}', 'RegisteredTeamsController@findById');
	Route::put('{season}/update-team/{team_id}', 'RegisteredTeamsController@update');
	Route::delete('/{season}/delete-team/{team_id}', 'RegisteredTeamsController@delete');


	Route::group(['prefix' => 'Event'], function() {
				Route::get('{season}/matches/InProgress', 'MatchesController@Matches_InProgressed_state');

		// Handling Matches through a Season
		Route::get('/{season}/matches', 'MatchesController@getSeasonMatches');
		Route::post('/{season}/matches', 'MatchesController@addMatch');
		//find match by date
		Route::get('{season}/matches/{date}', 'MatchesController@Find_Date');
		//find matches for this team 
		Route::get('{season}/{team}/matches', 'MatchesController@Find_Team_Matches');

		Route::put('{season}/update-match/{match}', 'MatchesController@update');
		Route::delete('{season}/delete-match/{match}', 'MatchesController@delete');
	});
	



	Route::get('/{season}/matches/stage/{stage_id}', 'MatchesController@findByStage');

	Route::post('/{season}/matches/{match}/confirm', 'MatchesController@confirmResult');




	// Handling players through a Season
	Route::get('{season}/{team}/players', 'RegisteredPlayersController@findAll');
	Route::get('{season}/{team}/{player}', 'RegisteredPlayersController@findById');
	Route::post('/{season}/{team}/Create', 'RegisteredPlayersController@Add_Player_In_RegisteredTeam');
	Route::put('{season}/{team}/{player}/update', 'RegisteredPlayersController@Update_Player_From_RegisteredTeam');
	Route::delete('/{season}/{team}/{player}', 'RegisteredPlayersController@Delete_Player_From_RegisteredTeam');


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
	
	Route::get('{team}/Players','PlayersController@Get_Player_For_Specific_Team');
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