<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Tag;
use Dom\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\ArticleService;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Cookie;

class ArticlesController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $articles = $this->articleService->getArticles($request);
        $categories = Categorie::all();
        $tags = Tag::all();

        return view('blog', compact('articles', 'categories', 'tags'));
    }

    public function show($id)
    {
        $article = $this->articleService->getArticleWithRelations($id);
        $similarArticles = $this->articleService->getSimilarArticles($article->id);
        $categories = Categorie::all();
        $tags = Tag::all();

        $user = auth()->check() || request()->has('auth_user');
        $owner = auth()->check() && auth()->user()->id === $article->user_id;

        return view('show_article', compact('user','article', 'similarArticles', 'categories', 'tags', 'owner'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $validated['user_id'] = Auth::id();
        $this->articleService->createArticle($validated);

        return back()->with('success', 'Article created successfully');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $this->articleService->updateArticle($id, $validated);

        return response()->json(['message' => 'Article updated successfully']);
    }

    public function destroy($id)
    {
        $this->articleService->deleteArticle($id);

        return response()->json(['message' => 'Article deleted successfully']);
    }
}
