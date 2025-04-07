<?php
namespace App\Services;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Dotenv\Repository\RepositoryInterface;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService{
    protected $authrepository;

    public function __construct(AuthRepositoryInterface $authrepository )
    {
    $this->authrepository=$authrepository;
    }

    public function register(array $data)
    {
        $newUser = $this->authrepository->register($data);
        $userToken = JWTAuth::fromUser($newUser);
        return [
            'success' => true,
            'user' => $newUser,
            'token' => $userToken
        ];
    }


    public function login(array $authData){
        $token = $this->authrepository->login($authData);
        if(!$token){
            return null;
        }
        return [
            'token' => $token,
        ];
    }
    public function logout()
        {
            $this->authrepository->logout();
        }


}
