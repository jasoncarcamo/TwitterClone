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
            'email'=>'required',
            'password'=>'required'
        ]);

        $newUser = $request;

        $UserService = new UserService();

        $hasUser = $UserService->getUser($request->input('email'));

        if($hasUser){
            return response( ['error'=> 'An account exists for this email already'] ,400);
        };

        $newUser['password'] = $UserService->hashPassword($newUser['password']);

        $UserService->insertUser([
            $request->input('name'), $request->input('email'), $request->input('password')
        ]);

        return response( $newUser, 200);
    }
}
