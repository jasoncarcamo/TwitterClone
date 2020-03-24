<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TweetsService;

class TweetsController extends Controller
{

    public function getUsersTweets(Request $request)
    {
        $TweetsService = new TweetsService();

        $tweets = $TweetsService->getUsersTweets($request->user->id);

        if(!$tweets){
            return response([
                'error' => 'No tweets found for this user'
            ], 404);
        };

        return response([
            'tweets' => $tweets
        ]);
    }

    public function createTweet(Request $request)
    {
        $hasTweetsInfo = $request->validate([
            'tweet_text' => 'required',
        ]);

        $TweetsService = new TweetsService();

        $newTweet = $request;

        $TweetsService->createTweet([
            $newTweet->tweet_text,
            $request->user->screen_name,
            $request->user->name,
            $request->user->id
        ]);

        return response([
            'success' => 'You have posted a new tweet'
        ], 200);

    }

    public function updateTweet(Request $request)
    {
        $hasTweet = $request->validate([
            'tweet_text' => 'required',
            'id' => 'required'
        ]);

        $TweetsService = new TweetsService();

        $updatedTweet = $request;

        $hasTweet = $TweetsService->getTweet($updatedTweet->id);

        if(!$hasTweet){
            return response([
                'error' => 'No tweet found'
            ], 404);
        };

        $TweetsService->updateTweet([
            $updatedTweet->tweet_text,
            $updatedTweet->id,
        ]);

        return response([
            'success' => 'Your tweet has been updated'
        ], 200);
    }

    public function deleteTweet(Request $request)
    {
        $TweetsService = new TweetsService();

        $hasTweet = $TweetsService->getTweet($request->input('id'));

        if(!$hasTweet){
            
            return response([
                'error' => 'No tweet found'
            ], 404);
        };

        $TweetsService->deleteTweet($request->input('id'));
    }
}
