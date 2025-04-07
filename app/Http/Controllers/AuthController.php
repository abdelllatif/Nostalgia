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
    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:8|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@\'&])[a-zA-Z0-9$@\'&]+$/',
        'first_name' => 'required|string|max:40',
        'phone_number' => 'nullable|string|max:15',
        'identity_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Hash the password before sending it to the service
    $validated['password'] = Hash::make($validated['password']);

    if ($request->hasFile('identity_image')) {
        $path = $request->file('identity_image')->store('identity_images', 'public');
        $validated['identity_image'] = $path;
    }

    $response = $this->authService->register($validated);

    if (!$response) {
        return response()->json(['error' => 'utilisateur pas enregistré'], 400);
    }

    return response()->json($response, 201);
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
