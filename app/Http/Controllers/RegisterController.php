<?php

namespace App\Http\Controllers;


use App\Services\UserService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {

    }

    public function register(Request $request)
    {
        //If the request request contains these form inputs continue
        $hasRequests = $request->validate([
            'name'=> 'required',
            'screen_name' => 'required',
            'email'=>'required',
            'password'=>'required'
        ]);

        $newUser = $request;

        $UserService = new UserService();

        $hasUser = $UserService->getUser($newUser->email);

        if($hasUser){
            return response( [
                'error'=> 'An account exists for this email already'
                ] ,400);
        };

        $newUser['password'] = $UserService->hashPassword($newUser['password']);

        $UserService->insertUser([
            $newUser->name,
            $newUser->screen_name,
            $newUser->email,
            $newUser->password
        ]);

        $token = $UserService->createToken($newUser['email']);

        return response( ['token'=> $token], 200);
    }
}
