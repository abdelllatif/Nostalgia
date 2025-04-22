<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Reaction;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\UserController;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardArticleController;

// Home routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/articles', [HomeController::class, 'article'])->name('articles.index');
Route::get('/products', [HomeController::class, 'product'])->name('products.index');

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
    route::post('/catalogue',[ProductController::class,'store'])->name('catalogue.store');
Route::get('/Dashebored/tags',[TagController::class,'index'] )->name('tags.show');
Route::get('/Dashebored/categories',[CategorieController::class,'index'])->name('categories.show');
Route::post('/Dashebored/categories',[CategorieController::class,'store'])->name('categories.store');
Route::delete('/Dashebored/categorie/{id}', [CategorieController::class, 'destroy'])->name('categorie.destroy');
Route::put('/Dashebored/categories/{id}', [CategorieController::class, 'update'])->name('categorie.edit');
Route::post('/bids', [BidController::class, 'store'])->name('bids.store');
Route::post('/Reaction', [ReactionController::class, 'store'])->name('reaction.add');
Route::POST('blog',[ArticlesController::class,'store'])->name('blog.store');
    // User's own profile
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/last-active-section', [UserProfileController::class, 'updateLastActiveSection'])->name('profile.last-active-section');

    // Public profiles
    Route::get('/users/{id}', [PublicProfileController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/articles', [PublicProfileController::class, 'articles'])->name('users.articles');
    Route::get('/users/{id}/products', [PublicProfileController::class, 'products'])->name('users.products');
    Route::get('/users/{id}/reactions', [UserProfileController::class, 'reactions'])->name('users.reactions');

    Route::get('/dashboard/articles', [DashboardArticleController::class, 'index'])->name('dashboard.articles');
    Route::post('/dashboard/articles/{article}/suspend', [DashboardArticleController::class, 'suspend'])->name('articles.suspend');
    Route::post('/dashboard/articles/{article}/restore', [DashboardArticleController::class, 'restore'])->name('articles.restore');
    Route::get('/dashboard/articles/filter', [DashboardArticleController::class, 'filter'])->name('articles.filter');
});
route::get('/register',[AuthController::class,'register_show']);
route::get('/login',[AuthController::class,'login_show'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
route::post('/login',[AuthController::class,'login']);
route::get('/terms',[AuthController::class,'terms_views']);
route::get('/En_Attend',[AuthController::class,'Attends_views'])->name('En_Attend');
route::get('/product/details/{id}',[ProductController::class,'show'])->name('product.details');
// Public route for viewing catalogue
Route::get('/catalogue',[ProductController::class,'index'])->name('catalogue.show');









Route::get('/test-email', function () {
    Mail::raw('This is a test email for Mailtrap!', function ($message) {
        $message->to('haissouneabdellatif749@gmail.com') // Replace with your target email
                ->subject('Test Email from Nostalgia');
    });

    return 'Test email has been sent!';
});


Route::get('blog',[ArticlesController::class,'index'])->name('blog.index');
Route::get('blog/Article/{article}', [ArticlesController::class, 'show'])->name('Article.show');
Route::put('Article/edit/{article}', [ArticlesController::class, 'update'])->name('Article.update');



Route::get('admin/users',[AdminUserController::class,'index'])->name('admin.users.index');

Route::post('/admin/users/{id}/approve', [AdminUserController::class, 'approve'])->name('users.approve');
Route::post('/admin/users/{id}/reject', [AdminUserController::class, 'reject'])->name('users.reject');
Route::post('/admin/users/{id}/suspend', [AdminUserController::class, 'suspend'])->name('admin.users.suspend');
Route::post('/admin/users/{id}/activate', [AdminUserController::class, 'activate'])->name('users.activate');
Route::get('/admin/users/{id}', [AdminUserController::class, 'view'])->name('admin.users.view');

Route::middleware(['auth'])->group(function () {

});

// Reaction routes
Route::put('/reactions/{id}', [ReactionController::class, 'update'])->name('reactions.update');
Route::delete('/reactions/{id}', [ReactionController::class, 'destroy'])->name('reactions.destroy');

// Dashboard Article Management Routes
Route::middleware(['auth', 'admin'])->group(function () {

});


