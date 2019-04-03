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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Create new feed
Route::post('feed', 'FeedController@store');
//Update feed
Route::put('feed', 'FeedController@store');
//Delete feed
Route::delete('feed/{id}', 'FeedController@destroy');


