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




	Route::get('{Season}/{team}/players', 'RegisteredPlayersController@Get_All_Players_In_Regiesterd_Teams');
	Route::get('{Season}/{team}/{player}', 'RegisteredPlayersController@Get_Update_View_Seasons');





	//post request for create new Season
	Route::post('Create', 'SeasonController@Create_Season');
	//put request for update Season and it will take id
	Route::put('Update/{id}', 'SeasonController@Update_Season');
	// delete request for deleting Season it will take id
	Route::delete('Delete/{id}', 'SeasonController@Destroy_Season');



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











Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});