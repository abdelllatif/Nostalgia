<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{

    public function show($id)
    {
        $user = User::findOrFail($id);

        $statistics = [
            'articles_count' => Article::where('user_id', $user->id)->count(),
            'products_count' => Product::where('user_id', $user->id)
                ->where('status', '!=', 'finished')
                ->count(),
        ];

        $articles = Article::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $products = Product::where('user_id', $user->id)
            ->where('status', '!=', 'finished')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('public_profile', compact(
            'user',
            'statistics',
            'articles',
            'products'
        ));
    }

    public function articles($id)
    {
        $user = User::findOrFail($id);

        $articles = Article::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('user_articles', compact('user', 'articles'));
    }

  
    public function products($id)
    {
        $user = User::findOrFail($id);

        $products = Product::where('user_id', $user->id)
            ->where('status', '!=', 'finished')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('user_products', compact('user', 'products'));
    }
}
