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
Route::group(['prefix' => 'Continent'], function() {
    Route::get('All-Continent','ContinentController@Get_All_Continents');
	Route::get('{id}','ContinentController@Get_Continent');
});
Route::group(['prefix' => 'country'], function() {
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
Route::group(['prefix' => 'competitions'], function() {
	Route::get('/', 'CompetitionsController@findAll');
	Route::get('/{competition}', 'CompetitionsController@findById');
	Route::post('/', 'CompetitionsController@create');
	Route::put('/upate/{competition}', 'CompetitionsController@update');
	Route::delete('/delete/{competition}', 'CompetitionsController@delete');
});
Route::group(['prefix' => 'Season'], function() {
	Route::get('All-Seasons', 'SeasonController@Get_All_Seasons');
	Route::get('Create', 'SeasonController@Get_Create_View_Season');
	Route::get('{Season}', 'SeasonController@Get_Season');
	Route::post('Create', 'SeasonController@Add_Season');
	//put request for update Season and it will take id
	Route::put('Update/{id}','SeasonController@Update_Season');
    // delete request for deleting Season it will take id
	Route::delete('{id}','SeasonController@destroy');
});


Route::group(['prefix' => 'teams'], function() {
	Route::get('All-Teams', 'TeamsController@Get_All_Teams');
	Route::get('{id}', 'TeamsController@Get_Team');

	Route::post('/Create', 'TeamsController@Create_Team');

	//put request for update Season and it will take id
	Route::put('Update/{id}','TeamsController@Update_Teams');
	// delete request for deleting Season it will take id
	Route::delete('{id}','TeamsController@destroy');

});


Route::group(['prefix' => 'player'], function() {
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







Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});