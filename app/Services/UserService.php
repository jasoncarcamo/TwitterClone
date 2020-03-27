<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUsers()
    {
        $users = DB::select('select * from users');

        return $users;
    }

    public function getUser($screen_name)
    {
        $hasUser = DB::select('select * from users where screen_name = ?', [$screen_name]);

        return $hasUser;
    }

    public function getUserById($id)
    {
        $user = DB::select('select * from users where id = ?', [$id]);

        return $user;
    }

    public function insertUser(Array $newUser)
    {
        $insertUser = DB::insert('insert into users (name, screen_name, email, password) values ( ?, ?, ?, ?)', $newUser);

        return $insertUser;
    }

    public function hashPassword($password)
    {
        return Hash::make($password);
    }

    public function verifyPassword($password, $dbPassword)
    {
        if(Hash::check($password, $dbPassword)){
            return true;
        } else{
            return false;
        };
    }

    public function createToken( $email )
    {
        // Create token header as a JSON string
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        // Create token payload as a JSON string
        $payload = json_encode(['email' => $email]);

        // Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));


        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $jwt;

    }

    public function verifyToken($token)
    {
        $payload = explode(".", $token);
        $decoded = base64_decode($payload[1]);

        return $decoded;
    }
}
