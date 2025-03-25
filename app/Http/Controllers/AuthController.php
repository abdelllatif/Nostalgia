<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\AuthService;
class AuthController  {
protected $authService;
public function __construct(AuthService $authService)
{
$this->authService=$authService;
}


public function register(Request $request)
{
    $request->validate([
        'name' => 'required|min:3|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:8|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@\'&])[a-zA-Z0-9$@\'&]+$/'
    ]);
    $result = $this->authService->register($request->all());
    if (!$result) {
    return response()->json(['error' => 'utilisateur pas registrer'], 400);
    }
    return response()->json($result, 201);
}


public function login(Request $request){
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);
    $response = $this->authService->login($request->only('email', 'password'));

    if (!$response) {
        return response()->json(['error' => 'not a user yet'], 401);
    }

    return response()->json($response);
}

public function logout(){
    $this->authService->logout();
    return response()->json(['message' => 'Successfully logged out']);
}
}
