<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class FollowService
{

    //Return followers
    public function getFollowers($user_id)
    {
        $followers = DB::select('select * from follow where follow = ? ', [$user_id]);

        return $followers;
    }


    //Return users following current user
    public function getFollowing($user_id)
    {

        $following = DB::select('select * from follow where user_id = ?', [$user_id]);

        return $following;
    }

    //Compares if following
    private function isFollowing($followId, $user_id)
    {
        $isFollowing = DB::select('select * from follow where follow = ? and user_id = ? ', [$followId, $user_id]);

        if($isFollowing){
            return true;
        } else{
            return false;
        }
    }

    //Create follow row
    public function followUser($followId, $user_id)
    {
        $isFollowing = $this->isFollowing($followId, $user_id);

        if($isFollowing){
            return false;
        }

        $followUser = DB::insert('insert into follow (follow, user_id) values (?, ?)', [$followId, $user_id]);

        return $followUser;
    }

    //Delete row when user unfollows
    public function unfollowUser($followId, $user_id)
    {
        $isFollowing = $this->isFollowing($followId, $user_id);

        if(!$isFollowing){

            return false;
        };

        $unfollowUser = DB::delete('delete from follow where follow = ? and user_id = ? ', [$followId, $user_id]);

        return $unfollowUser;
    }

}
