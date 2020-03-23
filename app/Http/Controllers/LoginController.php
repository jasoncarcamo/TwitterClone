<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $hasRequest = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $user = $request;

        $UserService = new UserService();

        $hasUser = $UserService->getUser($user->email);

        if(!$hasUser){
            return response([
                'error'=> "No user exists"
            ], 404);
        };

        $passwordMatches = $UserService->verifyPassword($user->password, $hasUser[0]->password);

        if(!$passwordMatches){
            return response([
                'error'=> 'The password does not match'
            ], 400);
        };

        $token = $UserService->createToken($user->email);

        return response([
            'token'=> $token
        ], 200);

    }
}
