<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JWTMiddleware extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            // Debug: Log the request details
            \Log::info('JWT Middleware Request:', [
                'url' => $request->url(),
                'method' => $request->method(),
                'has_cookie' => $request->hasCookie('jwt_token'),
                'cookie_value' => $request->cookie('jwt_token'),
                'all_cookies' => $request->cookies->all(),
                'headers' => $request->headers->all(),
                'cookie_domain' => config('session.domain'),
                'cookie_path' => '/',
                'secure' => config('app.env') === 'production',
                'same_site' => 'lax'
            ]);

            // First check if token is in cookie
            if ($token = $request->cookie('jwt_token')) {
                \Log::info('JWT Token found in cookie:', [
                    'token_length' => strlen($token),
                    'token_preview' => substr($token, 0, 10) . '...',
                    'cookie_attributes' => [
                        'domain' => config('session.domain'),
                        'path' => '/',
                        'secure' => config('app.env') === 'production',
                        'same_site' => 'lax'
                    ]
                ]);

                JWTAuth::setToken($token);
                $user = JWTAuth::authenticate();
                if (!$user) {
                    \Log::warning('JWT Authentication failed: Invalid token');
                    throw new \Tymon\JWTAuth\Exceptions\TokenInvalidException;
                }
                \Log::info('JWT Authentication successful:', ['user_id' => $user->id]);
            } else {
                \Log::warning('JWT Authentication failed: No token found');
                throw new \Tymon\JWTAuth\Exceptions\JWTException('Token not found');
            }
        } catch (Exception $e) {
            \Log::error('JWT Authentication error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'cookie_present' => $request->hasCookie('jwt_token'),
                'all_cookies' => $request->cookies->all()
            ]);
            session(['url.intended' => url()->full()]);
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        // Add user to request for convenient access in controllers and views
        $request->merge(['auth_user' => JWTAuth::user()]);

        return $next($request);
    }
}
