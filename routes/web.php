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

/*    Route::get('/', function () {
        return view('main.main');
    });*/
Route::get('/','BattleController@index');
Route::get('/battles','BattleController@battles');
Route::get('/playerData','BattleController@getPlayerData');
Route::get('/battleData','BattleController@getBattleData');