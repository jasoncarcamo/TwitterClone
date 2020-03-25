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

Route::group([
    'middleware' => 'cors'
], function () {

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
        Route::post('/', 'UserController@create')->name('createsusers');
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

    //Follow routes
    Route::group([
        'prefix' => '/',
        'middleware' => 'jwtAuth'
    ], function () {

        //Users followers
        Route::get('/followers', 'FollowController@getFollowers')->name('followers');


        //Users following
        Route::get('/following', 'FollowController@getFollowing')->name('follwing');

        //Follow route
        Route::post('/follow', 'FollowController@followUser')->name('followuser');
        Route::delete('/follow', 'FollowController@unfollowUser')->name('unfollowuser');
    });
});
