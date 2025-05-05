<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Product;
use App\Models\Categorie;
use App\Repositories\Interfaces\HomeRepositoryInterface;

class HomeRepository implements HomeRepositoryInterface
{
    public function getArticles()
    {
        return Article::with(['user', 'categorie', 'comments'])
            ->where('status', 'posted')
            ->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->get();
    }

    public function getProducts()
    {
        return Product::with(['category', 'bids'])
            ->where('status', 'active')
            ->withCount('bids')
            ->orderBy('bids_count', 'desc')
            ->take(3)
            ->get();
    }

    public function getTopCategories()
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
