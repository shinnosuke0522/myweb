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
// user list route
Route::resource('users','API\UserJsonController',['only'=>['index', 'show'] ]);


// Authentication Api route
Route::post('register', 'API\AuthJsonController@register');
Route::post('login','API\AuthJsonController@login');
Route::middleware('auth:api')->group(function(){
    Route::post('account', 'API\AuthJsonController@authDetail');
    Route::post('update_profile', 'API\AuthJsonController@update_profile');
    Route::post('logout', 'API\AuthJsonController@logout');
    Route::post('unregister','API\AuthJsonController@unregister');
});

