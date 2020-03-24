<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class TweetsService
{

    public function getTweet($id)
    {
        $tweet = DB::select('select * from tweets where id = ?', [$id]);

        return $tweet;
    }

    public function getUsersTweets($id)
    {
        $usersTweets = DB::select('select * from tweets where user_id = ?', [$id]);

        return $usersTweets;
    }

    public function createTweet(Array $tweet)
    {
        $createTweet = DB::insert('insert into tweets (tweet_text, screen_name, name, user_id) values (?, ?, ?, ?)', $tweet);

        return $createTweet;
    }

    public function updateTweet(Array $updatedTweet)
    {
        $updateTweet = DB::update('update tweets set tweet_text = ? where id = ?', $updatedTweet);

        return $updateTweet;
    }

    public function deleteTweet($id)
    {
        $deleteTweet = DB::delete('delete from tweets where id = ?', [$id]);

        return $deleteTweet;
    }
}
