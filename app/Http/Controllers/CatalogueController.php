<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CategorieService;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    protected $categoryService;

    public function __construct(CategorieService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $products = Product::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = $this->categoryService->getAllCategories();

        return view('catalogue', compact('products', 'categories'));
    }
}
