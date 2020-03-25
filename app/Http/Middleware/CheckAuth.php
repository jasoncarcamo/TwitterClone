<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\UserService;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $authToken = $request->header('Authorization');
        $bearerToken = "";
        $UserService = new UserService();

        if(strtolower(substr($authToken, 0, 6)) != 'bearer'){

            return response([
                'error' => 'Missing bearer token.'
            ], 401);
        };

        $bearerToken = substr($authToken, 7);
        ;
        $payload = json_decode($UserService->verifyToken($bearerToken));

        if(!$payload){

            return response([
                'error' => 'Unauthorized, Invalid user'
            ], 401);
        };

        $user = $UserService->getUser($payload->email);

        if(!$user){
            
            return response([
                'error' => 'No user found with this email'
            ]);
        };

        $request->user = $user[0];

        return $next($request);
    }
}
