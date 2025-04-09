<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/product/Details', function () {
    return view('product_details');
});
Route::get('/Dashebored/categories', function () {
    return view('Dashebored_categories');
});
route::middleware(['jwt.web'])->group(function(){
    Route::get('/profile',[profileController::class,'show'])->name('profile');
});
route::get('/register',[AuthController::class,'register_show']);
route::get('/login',[AuthController::class,'login_show'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
route::post('/login',[AuthController::class,'login']);
route::get('/terms',[AuthController::class,'terms_views']);
route::get('/En_Attend',[AuthController::class,'Attends_views'])->name('En_Attend');
