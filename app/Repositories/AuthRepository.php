<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use League\Uri\Contracts\AuthorityInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'first_name' => $data['first_name'],
            'phone_number' => $data['phone_number'] ?? null,
            'identity_image' => $data['identity_image'] ?? null,
        ]);
    }

    public function login(array $authData){
        if(!$token = JWTauth::attempt($authData)){
            return null;
        }
        return $token;
    }

    public function logout()
    {
        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);

        return response()->json(['message' => 'Successfully logged out.']);
    }

}
