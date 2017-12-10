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

	// Handling Matches through a Season
	Route::get('/{season}/matches', 'MatchesController@findAll');
	Route::post('/{season}/matches', 'MatchesController@create');
	Route::get('/{season}/matches/{match}', 'MatchesController@findById');
	Route::put('{season}/update-match/{match}', 'MatchesController@update');
	Route::delete('/{season}/delete-match/{match}', 'MatchesController@delete');
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





Route::group(['prefix' => 'Player'], function() {
	//get request to render the create.blade.php   [[  create new player form   ]]
    Route::get('Create','PlayerController@Get_Player_Create_View');
    //get request to render the update.blade.php   [[  update player form   ]]
    Route::get('Update/{id}','PlayerController@Get_Player_Update_View');
    //get request to retrive all Players
	Route::get('All-Players','PlayerController@Get_All_Players');
	//get request to retrive specific Players
    Route::get('{id}','PlayerController@Get_Player');


    //post request for create new country
	Route::post('Create','PlayerController@Create_Player');
	//put request for update country and it will take id
	Route::put('Update/{id}','PlayerController@Update_Player');

    // delete request for deleting country it will take id
	Route::delete('{id}','PlayerController@destroy');
});

Route::group(['prefix' => 'matches'], function() {
	Route::get('/', 'MatchesController@findAll');
	Route::post('/matches', 'MatchesController@create');
	Route::get('/{match}', 'MatchesController@findById');
	Route::get('/{date}', 'MatchesController@findByDay');
	Route::get('/{week}', 'MatchesController@findByStages');
	Route::put('/update/{match}', 'MatchesController@update');
	Route::delete('/delete/{match}', 'MatchesController@delete');
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});