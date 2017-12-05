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

Route::get('/competitions', 'CompetitionsController@findAll');
Route::get('/competitions/{competition}', 'CompetitionsController@findById');
Route::post('/competitions', 'CompetitionsController@create');
Route::put('/competitions/upate/{competition}', 'CompetitionsController@update');
Route::delete('competitions/delete/{competition}', 'CompetitionsController@delete');

