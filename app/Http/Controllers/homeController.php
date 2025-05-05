<?php

namespace App\Http\Controllers;

use App\Services\HomeService;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $articles = $this->homeService->getArticles();
        $products = $this->homeService->getProducts();
        $topCategories = $this->homeService->getTopCategories();

        return view('welcome', compact('articles', 'products', 'topCategories'));
    }
}
