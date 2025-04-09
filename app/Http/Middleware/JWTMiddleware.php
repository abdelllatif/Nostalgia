<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JWTMiddleware extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            // First check if token is in cookie
            if ($token = $request->cookie('jwt_token')) {
                JWTAuth::setToken($token);
                $user = JWTAuth::authenticate();
                if (!$user) {
                    throw new \Tymon\JWTAuth\Exceptions\TokenInvalidException;
                }
            } else {
                // No token found in cookie
                throw new \Tymon\JWTAuth\Exceptions\JWTException('Token not found');
            }
        } catch (Exception $e) {
            // For web routes, redirect to login page instead of returning JSON
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        // Add user to request for convenient access in controllers and views
        $request->merge(['auth_user' => JWTAuth::user()]);

        return $next($request);
    }
}
