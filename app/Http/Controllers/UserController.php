<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::select('select * from users');

        return response($users, 200);

    }

    public function create( Request $request)
    {


        $hashedPassword = "";

        return response($request->input('address'), 200);

    }

    public function edit(Request $request)
    {

    }

    
}
