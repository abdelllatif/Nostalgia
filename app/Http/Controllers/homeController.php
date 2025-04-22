<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index()
    {
    $articles=$this->article();

    $products=$this->product();


        $topCategories = $this->topCategories();

        return view('welcome', compact('articles', 'products', 'topCategories'));
    }

    public function article()
    {
        $articles = Article::with(['user', 'categorie', 'comments'])
            ->where('status', 'posted')
            ->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->get();

        return $articles;
    }
    public function product()
    {
        $products = Product::with(['category', 'bids'])
            ->where('status', 'active')
            ->withCount('bids')
            ->orderBy('bids_count', 'desc')
            ->take(3)
            ->get();

        return $products;
    }

    private function topCategories()
    {
        return Categorie::select('categories.*')
            ->selectRaw('COUNT(DISTINCT articles.id) as article_count')
            ->selectRaw('COUNT(DISTINCT products.id) as product_count')
            ->leftJoin('articles', 'categories.id', '=', 'articles.category_id')
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->groupBy('categories.id')
            ->orderByRaw('(COUNT(DISTINCT articles.id) + COUNT(DISTINCT products.id)) DESC')
            ->take(5)
            ->get();
    }
}
