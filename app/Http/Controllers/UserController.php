<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\UserService;

class UserController extends Controller
{

    public function index()
    {
        $UserService = new UserService();

        $users = $UserService->getUsers();

        return response($users, 200);

    }

    public function getUser(Request $request, $screen_name)
    {

        if(!$screen_name){

            return response([
                'error' => 'Missing screen_name in params /api/user/{screen_name}'
            ], 400);
        };

        $UserService = new UserService();

        $user = $UserService->getUser($screen_name);

        if(!$user){

            return response([
                'error' => 'No user found'
            ], 404);
        };

        return response([
            'user' => [
                'name' => $user[0]->name,
                'screen_name' => $user[0]->screen_name,
                'email' => $user[0]->email
            ]
            ], 200);

    }

    public function create( Request $request)
    {


        $hashedPassword = "";

        return response($request->input('email'), 200);

    }

    public function edit(Request $request)
    {

    }


}
