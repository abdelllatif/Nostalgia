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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ErrorController;

//this is  Home page
Route::get('/', function () {
    return view('welcome');
})->name('home');

//  those are Catalogue routes
Route::get('/catalogue', [ProductController::class, 'index'])->name('catalogue');
Route::get('/catalogue/{product}', [ProductController::class, 'show'])->name('catalogue.show');

// those are the Blog routes
Route::get('/blog', [ArticlesController::class, 'index'])->name('blog.index');
Route::get('/blog/{article}', [BlogController::class, 'show'])->name('blog.show');

// those are Error routes
Route::get('/unauthorized', [ErrorController::class, 'unauthorized'])->name('unauthorized');
Route::get('/404', [ErrorController::class, 'notFound'])->name('404');
Route::get('/500', [ErrorController::class, 'serverError'])->name('500');

// those are a Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog/{article}', [BlogController::class, 'show'])->name('blog.show');

// Product routes - public view, protected actions lilke bidding and payement
Route::get('/product/details/{product}', [ProductController::class, 'show'])
    ->name('product.details')
    ->middleware(\App\Http\Middleware\CheckAuctionAccess::class);

// Protected routes bythe authentication midelware
Route::middleware(['jwt.web'])->group(function () {
    // Product actions like the biding and payement
    Route::post('/product/{product}/bid', [ProductController::class, 'placeBid'])->name('product.bid');
    Route::post('/product/{product}/pay', [ProductController::class, 'processPayment'])->name('product.pay');

    // User routes persenall
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/my-products', [UserController::class, 'products'])->name('user.products');
    Route::get('/my-articles', [UserController::class, 'articles'])->name('user.articles');
    Route::get('/my-bids', [UserController::class, 'bids'])->name('user.bids');

    // Other protected routes like dashebored of admin that will have alnother midelware of the admin
    Route::post('/catalogue',[ProductController::class,'store'])->name('catalogue.store');
    Route::get('/Dashebored/tags',[TagController::class,'index'] )->name('tags.show');
    Route::get('/Dashebored/categories',[CategorieController::class,'index'])->name('categories.show');
    Route::post('/Dashebored/categories',[CategorieController::class,'store'])->name('categories.store');
    Route::delete('/Dashebored/categorie/{id}', [CategorieController::class, 'destroy'])->name('categorie.destroy');
    Route::put('/Dashebored/categories/{id}', [CategorieController::class, 'update'])->name('categorie.edit');
    Route::post('/Reaction', [ReactionController::class, 'store'])->name('reaction.add');
    Route::delete('/reaction', [ReactionController::class, 'destroy'])->name('reaction.destroy');
    Route::POST('blog',[ArticlesController::class,'store'])->name('blog.store');

    // User's own profile
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [UserProfileController::class, 'updatePassword'])->name('profile.password');
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

    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
    Route::get('/notifications/recent', [NotificationController::class, 'getRecentNotifications'])->name('notifications.recent');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

// Auth routes
Route::get('/login', [AuthController::class, 'login_show'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register_show'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Admin routes
Route::get('admin/users',[AdminUserController::class,'index'])->name('admin.users.index');
Route::post('/admin/users/{id}/approve', [AdminUserController::class, 'approve'])->name('users.approve');
Route::post('/admin/users/{id}/reject', [AdminUserController::class, 'reject'])->name('users.reject');
Route::post('/admin/users/{id}/suspend', [AdminUserController::class, 'suspend'])->name('admin.users.suspend');
Route::post('/admin/users/{id}/activate', [AdminUserController::class, 'activate'])->name('users.activate');
Route::get('/admin/users/{id}', [AdminUserController::class, 'view'])->name('admin.users.view');

// Reaction routes
Route::put('/reactions/{id}', [ReactionController::class, 'update'])->name('reactions.update');
Route::delete('/reactions/{id}', [ReactionController::class, 'destroy'])->name('reactions.destroy');
