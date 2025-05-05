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
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardStatsController;

//this is  Home page
Route::get('/', function () {
    return view('welcome');
})->name('home');
route::get('/En_Attend',[AuthController::class,'Attends_views'])->name('En_Attend');

//  those are Catalogue routes
Route::get('/catalogue', [ProductController::class, 'index'])->name('catalogue');
Route::get('/catalogue/{product}', [ProductController::class, 'show'])->name('catalogue.show');

// those are the Blog routes
Route::get('/blog', [ArticlesController::class, 'index'])->name('blog.index');
Route::get('/blog/{article}', [ArticlesController::class, 'show'])->name('blog.show');

// those are Error routes
Route::get('/unauthorized', [ErrorController::class, 'unauthorized'])->name('unauthorized');
Route::get('/404', [ErrorController::class, 'notFound'])->name('404');
Route::get('/500', [ErrorController::class, 'serverError'])->name('500');

// those are a Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Product routes - public view, protected actions lilke bidding and payement
Route::get('/product/details/{product}', [ProductController::class, 'show'])
    ->name('product.details')
    ->middleware(\App\Http\Middleware\CheckAuctionAccess::class);

// Protected routes bythe authentication midelware
Route::middleware(['jwt.web'])->group(function () {
    // Product actions like the biding and payement
    Route::post('/product/{product}/bid', [BidController::class, 'store'])->name('bids.store');
    Route::post('/product/{product}/pay', [ProductController::class, 'processPayment'])->name('product.pay');

    // User routes persenall
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/my-products', [UserController::class, 'products'])->name('user.products');
    Route::get('/my-articles', [UserController::class, 'articles'])->name('user.articles');
    Route::get('/my-bids', [UserController::class, 'bids'])->name('user.bids');

    // Other protected routes like dashebored of admin that will have alnother midelware of the admin
    Route::post('/catalogue',[ProductController::class,'store'])->name('catalogue.store');
    Route::get('/Dashebored/tags',[TagController::class,'index'] )->name('tags.index');
    Route::post('/Dashebored/tags',[TagController::class,'store'] )->name('tags.store');
    Route::put('/Dashebored/tags/{id}',[TagController::class,'update'] )->name('tags.update');
    Route::delete('/Dashebored/tags/{id}',[TagController::class,'destroy'] )->name('tags.destroy');

    Route::prefix('Dashebored')->group(function () {
        Route::get('/categories', [CategorieController::class, 'index'])->name('categories.show');
        Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
        Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categorie.edit');
        Route::get('/admin-products', [DashboardProductController::class, 'index'])->name('dashboard.products');
        Route::get('/articles', [DashboardArticleController::class, 'index'])->name('dashboard.articles');
        Route::patch('/articles/{article}/suspend', [DashboardArticleController::class, 'suspend'])->name('articles.suspend');
        Route::patch('/articles/{article}/restore', [DashboardArticleController::class, 'restore'])->name('articles.restore');
        Route::get('/articles/filter', [DashboardArticleController::class, 'filter'])->name('articles.filter');
        Route::get('/statistics', [DashboardStatsController::class, 'index'])->name('dashboard.statistics');
    });

    Route::post('/Reaction', [ReactionController::class, 'store'])->name('reaction.add');
    Route::delete('/reaction', [ReactionController::class, 'destroy'])->name('reaction.destroy');
    Route::POST('blog',[ArticlesController::class,'store'])->name('blog.store');
    Route::put('/blog/{article}', [ArticlesController::class, 'update'])->name('blog.update');

    // User's own profile
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [UserProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/last-active-section', [UserProfileController::class, 'updateLastActiveSection'])->name('profile.last-active-section');

    // Public profiles
    Route::get('/user/{id}', [PublicProfileController::class, 'show'])->name('user.show');
    Route::get('/user/{id}/articles', [PublicProfileController::class, 'articles'])->name('user.articles');
    Route::get('/user/{id}/products', [PublicProfileController::class, 'products'])->name('user.products');
    Route::get('/users/{id}/reactions', [UserProfileController::class, 'reactions'])->name('users.reactions');

    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
    Route::get('/notifications/recent', [NotificationController::class, 'getRecentNotifications'])->name('notifications.recent');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Payment routes
    Route::get('/payment/create/{product}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/payment/checkout/{product}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment/success/{product}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/failed/{product}', [PaymentController::class, 'failed'])->name('payment.failed');
    Route::get('/payment/{product}/download-ticket', [PaymentController::class, 'downloadTicket'])->name('payment.download-ticket');
});

// Auth routes
Route::get('/login', [AuthController::class, 'login_show'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register_show'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::middleware(['jwt.web','admin'])->group(function () {
// Admin routes
Route::get('admin/users',[AdminUserController::class,'index'])->name('admin.users.index');
Route::post('/admin/users/{id}/approve', [AdminUserController::class, 'approve'])->name('users.approve');
Route::post('/admin/users/{id}/reject', [AdminUserController::class, 'reject'])->name('users.reject');
Route::post('/admin/users/{id}/suspend', [AdminUserController::class, 'suspend'])->name('admin.users.suspend');
Route::post('/admin/users/{id}/activate', [AdminUserController::class, 'activate'])->name('admin.users.activate');
Route::get('/admin/users/{id}', [AdminUserController::class, 'view'])->name('admin.users.view');
});
// Reaction routes
Route::put('/reactions/{id}', [ReactionController::class, 'update'])->name('reactions.update');
Route::delete('/reactions/{id}', [ReactionController::class, 'destroy'])->name('reactions.destroy');

// Article Management Routes
    Route::get('/dashboard/articles', [DashboardArticleController::class, 'index'])->name('dashboard.articles');
    Route::patch('/dashboard/articles/{article}/suspend', [DashboardArticleController::class, 'suspend'])->name('dashboard.articles.suspend');
    Route::patch('/dashboard/articles/{article}/restore', [DashboardArticleController::class, 'restore'])->name('dashboard.articles.restore');
