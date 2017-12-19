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

	Route::get('create','CompetitionsController@Create_View');
	Route::post('create','CompetitionsController@createCompetition');
	Route::get('All-Competitions','CompetitionsController@All_Competitions_View');
	Route::get('{Competition}','CompetitionsController@Specific_Competition_View');

	Route::group(['prefix' => '{competition}/seasons'], function() {
		Route::post('create','SeasonController@create');
		Route::get('seasons','SeasonController@All_Seasons_View');
		Route::get('{Competition}','SeasonController@Specific_Season_View');
	});


});


Route::group(['prefix' => 'seasons/{season}/teams/{team}/players'], function() {
	Route::get('create','RegisteredPlayersController@addView');
	Route::post('create','RegisteredPlayersController@add');
	Route::get('seasons','SeasonController@All_Seasons_View');
	Route::get('{Competition}','SeasonController@Specific_Season_View');
});





