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

Route::post('login','Api\AuthController@postLogin');
Route::post('register', 'Api\AuthController@postRegister');
Route::post('refresh', 'Api\AuthController@postRefresh');


Route::middleware('auth:api')->group(function(){
    Route::get('user','Api\UserController@getUser');

    Route::post('logout','Api\AuthController@postLogout');
    Route::post('edit-profile','Api\UserController@postEditProfile');
    Route::post('edit-password','Api\UserController@postEditPassword');

    Route::post('save-location','Api\LocationController@saveLocation');
   	Route::get('last-locations','Api\LocationController@getLastLocations'); 
   	Route::get('location-history/{id}', 'Api\LocationController@getLocationHistory');
});