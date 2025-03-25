<?php
namespace App\Repositories\Interfaces;

interface AuthRepositoryInterface{

    public function register(array $data);
    public function login(array $authData);
    public function logout();
}
