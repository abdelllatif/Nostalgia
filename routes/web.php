<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
});
route::get('/register',[AuthController::class,'register_show']);
route::get('/login',[AuthController::class,'login_show']);
route::post('/register',[AuthController::class,'register']);
route::post('/login',[AuthController::class,'login']);
route::get('/terms',[AuthController::class,'terms_views']);
route::get('/En_Attend',[AuthController::class,'Attends_views']);
