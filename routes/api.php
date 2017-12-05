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

<<<<<<< HEAD
Route::get('/competitions', 'CompetitionsController@findAll');
Route::get('/competitions/{competition}', 'CompetitionsController@findById');
Route::post('/competitions', 'CompetitionsController@create');
Route::put('/competitions/upate/{competition}', 'CompetitionsController@update');
Route::delete('competitions/delete/{competition}', 'CompetitionsController@delete');

Route::post('/teams', 'TeamsController@create');

=======
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
>>>>>>> 3cce80a782f5afba1cefe38abe97b0b9973284c6
