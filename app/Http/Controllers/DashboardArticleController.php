<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['user'])
            ->latest()
            ->paginate(10);

        // Calculate statistics
        $total_articles = Article::count();
        $published_articles = Article::where('status', 'published')->count();
        $suspended_articles = Article::where('status', 'suspended')->count();
        $pending_articles = Article::where('status', 'pending')->count();

        return view('Dashebored_articles', compact(
            'articles',
            'total_articles',
            'published_articles',
            'suspended_articles',
            'pending_articles'
        ));
    }

    public function suspend(Article $article)
    {
        if ($article->status !== 'posted') {
            return back()->with('error', 'Seuls les articles publiés peuvent être suspendus.');
        }

        $article->update(['status' => 'suspended']);

        return back()->with('success', 'L\'article a été suspendu avec succès.');
    }

    public function restore(Article $article)
    {
        if ($article->status !== 'suspended') {
            return back()->with('error', 'Seuls les articles suspendus peuvent être restaurés.');
        }

        $article->update(['status' => 'posted']);

        return back()->with('success', 'L\'article a été restauré avec succès.');
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
