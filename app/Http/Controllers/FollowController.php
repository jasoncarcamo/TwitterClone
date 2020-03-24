<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FollowService;
use App\Services\UserService;

class FollowController extends Controller
{

    //Get followers of current user
    public function getFollowers(Request $request)
    {
        $FollowService = new FollowService();

        $followers =$FollowService->getFollowers($request->user->id);

        if(!$followers){

            return response([
                'error' => 'You do not have any followers yet'
            ], 404);
        };

        return response([
            'followers' => $followers
        ], 200);
    }

    //Get all users the current user is following
    public function getFollowing(Request $request)
    {

        $FollowService = new FollowService();

        $following = $FollowService->getFollowing($request->user->id);

        if(!$following){

            return response([
                'error' => 'You do not follow anyone yet'
            ], 404);
        };

        return response([
            'following' => $following
        ], 200);

    }

    //Create follow row
    public function followUser(Request $request)
    {
        if(!$request->input('follow')){

            return response([
                'error' => 'Missing follow in body request'
            ], 400);
        };

        $followRequest = $request;

        $UserService = new UserService();

        $FollowService = new FollowService();

        $userexists = $UserService->getUserById($followRequest->follow);

        if(!$userexists){

            return response([
                'error' => 'The user you are trying to follow does not exist'
            ], 404);
        };

        if($userexists[0]->id == $request->user->id){

            return response([
                'error' => 'You can not follow yourself'
            ], 400);
        };

        $follow = $FollowService->followUser($followRequest->follow, $request->user->id);

        if($follow === false){
            return response([
                'error' => 'You are following this user already'
            ], 400);
        };

        return response([
            'success' => 'You are now following '. $userexists[0]->screen_name
        ], 200);

    }

    //Instead of updating the table when unfollowing users
    //We will delete the row to save memory
    public function unfollowUser(Request $request)
    {
        if(!$request->input('follow')){

            return response([
                'error' => 'Missing follow in body request'
            ], 400);
        };

        $unfollowRequest = $request;

        $UserService = new UserService();
        $FollowService = new FollowService();

        $userexists = $UserService->getUserById( $unfollowRequest->follow);

        if(!$userexists){

            return response([
                'error' => 'The user you are trying to unfollow does not exist'
            ], 404);
        };

        $unfollowUser = $FollowService->unfollowUser( $unfollowRequest->follow, $request->user->id);

        if($unfollowUser == false){

            return response([
                'error' => 'You are not following this user'
            ], 400);
        };

        return response([
            'success' => 'You are no long following '. $userexists[0]->screen_name
        ], 200);

    }
}
