<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        $articles = $this->articleService->getAllArticles();
        return response()->json($articles);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:posted,waiting,suspended',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id'
        ]);

        // رفع الصورة
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article = $this->articleService->createArticle($data);
        return response()->json($article, 201);
    }

    public function show($id)
    {
        $article = $this->articleService->findArticleById($id);

        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        return response()->json($article);
    }

    public function update(Request $request, $id)
    {
        $article = $this->articleService->findArticleById($id);

        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'sometimes|in:posted,waiting,suspended',
            'category_id' => 'sometimes|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $article->image);
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $updatedArticle = $this->articleService->updateArticle($id, $data);
        return response()->json($updatedArticle);
    }

    public function destroy($id)
    {
        $deleted = $this->articleService->deleteArticle($id);

        if (!$deleted) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        return response()->json(['message' => 'Article deleted successfully']);
    }

    public function userArticles($userId)
    {
        $articles = $this->articleService->getUserArticles($userId);
        return response()->json($articles);
    }
}
