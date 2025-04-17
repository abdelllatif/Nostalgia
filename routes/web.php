<?php

use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ArticleController;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/product/Details', function () {
    return view('product_details');
});

Route::get('/hh-test', function() {
    return "Testing catalogue route";
});
route::middleware(['jwt.web'])->group(function(){
    Route::get('/profile',[profileController::class,'show'])->name('profile');
    route::post('/catalogue',[ProductController::class,'store'])->name('catalogue.store');
Route::get('/Dashebored/tags',[TagController::class,'index'] )->name('tags.show');
Route::get('/Dashebored/categories',[CategorieController::class,'index'])->name('categories.show');
Route::post('/Dashebored/categories',[CategorieController::class,'store'])->name('categories.store');
Route::delete('/Dashebored/categorie/{id}', [CategorieController::class, 'destroy'])->name('categorie.destroy');
Route::put('/Dashebored/categories/{id}', [CategorieController::class, 'update'])->name('categorie.edit');
Route::post('/bids', [BidController::class, 'store'])->name('bids.store');


});
route::get('/register',[AuthController::class,'register_show']);
route::get('/login',[AuthController::class,'login_show'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
route::post('/login',[AuthController::class,'login']);
route::get('/terms',[AuthController::class,'terms_views']);
route::get('/En_Attend',[AuthController::class,'Attends_views'])->name('En_Attend');
route::get('/product/details/{id}',[ProductController::class,'show'])->name('product.details');
Route::get('/catalogue',[ProductController::class,'index'])->name('catalogue.show');









Route::get('/test-email', function () {
    Mail::raw('This is a test email for Mailtrap!', function ($message) {
        $message->to('haissouneabdellatif749@gmail.com') // Replace with your target email
                ->subject('Test Email from Nostalgia');
    });

    return 'Test email has been sent!';
});






Route::get('admin/users',[AdminUserController::class,'index'])->name('admin.users.index');

Route::post('/admin/users/{id}/approve', [AdminUserController::class, 'approve'])->name('admin.users.approve');
Route::post('/admin/users/{id}/reject', [AdminUserController::class, 'reject'])->name('admin.users.reject');
Route::post('/admin/users/{id}/suspend', [AdminUserController::class, 'suspend'])->name('admin.users.suspend');
Route::post('/admin/users/{id}/activate', [AdminUserController::class, 'activate'])->name('admin.users.activate');
Route::get('/admin/users/{id}', [AdminUserController::class, 'view'])->name('admin.users.view');
