<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Auth;

class UserService 
{

    public function getUser($email)
    {
        $hasUser = DB::select('select * from users where email = ?', [$email]);

        return $hasUser;
    }

    public function insertUser(Array $newUser)
    {
        $insertUser = DB::insert('insert into users (name, email, password) values ( ?, ?, ?)', $newUser);

        return $insertUser;
    }

    public function hashPassword($password)
    {
        return Hash::make($password);
    }

    public function createToken( $email, $password)
    {
        $token = auth->attempt([$email, $password]);

        return $token;
    }
}
