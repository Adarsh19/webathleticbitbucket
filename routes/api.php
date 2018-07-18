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

Route::group(array('middleware' => 'auth.api'), function () {
	//Login
	Route::post('login', ['as' => 'api-login','uses' => 'API\AuthController@index']);

    Route::post('logout', ['as' => 'api-logout','uses' => 'API\AuthController@logout']);

	Route::post('mark-checkin', ['as' => 'api-mark-checkin','uses' => 'API\UserController@markCheck']);

});