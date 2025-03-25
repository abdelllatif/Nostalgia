<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use League\Uri\Contracts\AuthorityInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>hash::make($data['password']),
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
