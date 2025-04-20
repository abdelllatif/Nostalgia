<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    /**
     * Display a public profile for a specific user
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        // Get user statistics
        $statistics = [
            'articles_count' => Article::where('user_id', $user->id)->count(),
            'products_count' => Product::where('user_id', $user->id)
                ->where('status', '!=', 'finished')
                ->count(),
        ];

        // Get user's public articles
        $articles = Article::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Get user's active products
        $products = Product::where('user_id', $user->id)
            ->where('status', '!=', 'finished')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('public_profile', compact(
            'user',
            'statistics',
            'articles',
            'products'
        ));
    }

   
}
