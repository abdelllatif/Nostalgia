<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController  {
protected $authService;
public function __construct(AuthService $authService)
{
$this->authService=$authService;
}

public function register_show(){
    return view('register');
}

public function login_show(){
    return view('login');
}
public function terms_views(){
    return view('terms');
}
public function Attends_views(){
    return view('user_Attends');
}
public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:8|string',
        'first_name' => 'required|string|max:40',
        'phone_number' => 'nullable|string|max:15',
        'identity_image' => 'required|image|mimes:jpeg,png',
    ]);
    $validated['password'] = Hash::make($validated['password']);

    if ($request->hasFile('identity_image')) {
        $path = $request->file('identity_image')->store('identity_images', 'public');
        $validated['identity_image'] = $path;
    }

    $response = $this->authService->register($validated);

    if (!$response) {
        return redirect()->route('register.post')->with('error', 'Inscription échouée. Veuillez réessayer.');
    }

    return redirect()->route('En_Attend')->with('success', 'Inscription réussie. matenent vous devez attendez lz reponse de l\'admin !');
}


public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    $token = $this->authService->login($request->only('email', 'password'));

    if (!$token) {
        return redirect()->route('login')->with('error', 'Login failed. Please try again.');
    }

    return redirect('/profile')->with('success', 'Login successful.');
}

public function logout(){
    $this->authService->logout();
    return response()->json(['message' => 'Successfully logged out']);
}
}
