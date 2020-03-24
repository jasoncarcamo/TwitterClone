<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class TweetsService
{
    public function createTweet($tweet)
    {
        $createTweet = DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
    }
}
