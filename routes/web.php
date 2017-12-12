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
	Route::get('/', 'CompetitionsController@findAll');
	Route::post('/', 'CompetitionsController@create');
	Route::get('/{competition}', 'CompetitionsController@findById');
	Route::put('/update/{competition}', 'CompetitionsController@update');
	Route::delete('/delete/{competition}', 'CompetitionsController@delete');
});
