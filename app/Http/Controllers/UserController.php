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

    public function getUser()
    {

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
