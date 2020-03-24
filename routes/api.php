<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



//Register route
Route::group(['prefix' => 'register'], function () {
    Route::post('/', 'RegisterController@register')->name('register');
});

//Login route
Route::group(['prefix' => 'login'], function () {
    Route::post('/', 'LoginController@login')->name('login')->middleware("cors");
});

//Users routes
Route::group([
    'prefix' => 'user',
], function () {
    Route::get('/', 'UserController@index')->name('user');
    Route::post('/', 'UserController@create')->name('createsusers')->middleware('jwtAuth');
});

//Tweets routes
Route::group([
    'prefix' => 'tweets',
    'middleware' => 'jwtAuth'
], function () {
    Route::get('/', 'TweetsController@getUsersTweets')->name('usertweets');
    Route::post('/', 'TweetsController@createTweet')->name('createtweet');
    Route::patch('/', 'TweetsController@updateTweet')->name('updatetweet');
    Route::delete('/', 'TweetsController@deleteTweet')->name('deletetweet');
});

