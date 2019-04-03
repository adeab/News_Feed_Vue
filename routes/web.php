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
//List of feeds
Route::get('feeds/api', 'FeedController@index');

//Single feed
Route::get('feed/api/{id}', 'FeedController@show');

// //Create new feed
// Route::post('feed/api', 'FeedController@store');

// //Update feed
// Route::put('feed/api', 'FeedController@store');

// //Delete feed
// Route::delete('feed/api/{id}', 'FeedController@destroy');

Route::get('feeds', 'PagesController@feed');