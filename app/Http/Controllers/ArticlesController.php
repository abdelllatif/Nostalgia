<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Tag;
use Dom\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['user', 'categorie', 'tags'])
            ->where('status', 'posted');

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                ->orWhere('content', 'like', "%{$request->search}%");
            });
        }

        if ($request->tag) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('tags.id', $request->tag);
            });
        }

        $articles = $query->latest()->paginate(12);
        $categories = Categorie::all();
        $tags = Tag::all();

        return view('blog', compact('articles', 'categories', 'tags'));
    }

    public function show(Article $article)
    {
        $article->load(['user', 'categorie', 'tags']);

        // Change this line to remove the dd() and properly load comments with users
        $article->load(['comments.user', 'ratings.user']);

        $similarArticles = Article::where('id', '!=', $article->id)
            ->with(['user', 'categorie', 'tags'])
            ->take(4)
            ->get();
            $categories = Categorie::all();
            $tags = Tag::all();
        return view('show_article', compact('article', 'similarArticles','categories','tags'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:2255', // كذلك max خصها تكون رقم معقول، غادي نرجع لها
                'content' => 'required|string', // <-- هنا صلحناها
                'category_id' => 'required|exists:categories,id',
                'tags' => 'array',
                'tags.*' => 'exists:tags,id',
                'image' => 'nullable|image|max:5120' // 5MB مثلا
            ]);
            $article = new Article($validated);
            $article->user_id = Auth::user()->id;
            $article->status = 'posted';

            if ($request->hasFile('image')) {
                $article->image = $request->file('image')->store('articles', 'public');
            }

            $article->save();

            if ($request->tags) {
                $article->tags()->attach($request->tags);
            }
            dd($article);
            return redirect()->route('blog')->with('succsess','artricle creaated sucsses');


        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de l\'article: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Article $article)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($validated);
        $article->tags()->sync($request->tags);

        return response()->json(['message' => 'Article updated successfully', 'article' => $article]);
    }

    public function destroy(Article $article)
    {

        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return response()->json(['message' => 'Article deleted successfully']);
    }
}
