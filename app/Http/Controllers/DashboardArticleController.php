<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['user', 'categorie']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->latest()->paginate(10);
        $categories = Categorie::all();
        $adminName = Auth::user()->name;

        return view('dashboard_articles', compact('articles', 'categories', 'adminName'));
    }

    public function suspend(Article $article)
    {
        $article->update(['status' => 'suspended']);

        return redirect()->route('dashboard.articles')
            ->with('success', 'L\'article a été suspendu avec succès.');
    }

    public function restore(Article $article)
    {
        $article->update(['status' => 'posted']);

        return redirect()->route('dashboard.articles')
            ->with('success', 'L\'article a été restauré avec succès.');
    }

    public function filter(Request $request)
    {
        $query = Article::with(['user', 'categorie']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->latest()->paginate(10);
        $categories = Categorie::all();

        return view('dashboard_articles', compact('articles', 'categories'));
    }
}
