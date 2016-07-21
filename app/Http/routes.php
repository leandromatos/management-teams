<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return view('welcome');
});

// Just for example
Auth::logout();
// 1 Admin
// 2 Manager
// 3 User (Owner of team 3)
Auth::loginUsingId(1);

Route::get('teams/{team}', ['uses' => 'TeamController@show', 'as' => 'team.show']);
Route::get('teams/{team}/edit', ['uses' => 'TeamController@edit', 'as' => 'team.edit']);
