<?php
namespace App\Repositories;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Tag;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleRepository implements ArticleRepositoryInterface
{
    protected $model;

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function getAll($filterby)
    {
        return $this->model->with(['user', 'category', 'tags'])->orderBy($filterby,'asc')->get();
    }

    public function findById($id)
    {
        return $this->model->with(['user', 'category', 'tags'])->find($id);
    }

    public function create(array $data)
    {
        $article = $this->model->create($data);

        if (isset($data['tags'])) {
            $article->tags()->sync($data['tags']);
        }

        return $article->load(['user', 'category', 'tags']);
    }

    public function update($id, array $data)
    {
        $article = $this->model->find($id);

        if (!$article) {
            return false;
        }

        $article->update($data);

        if (isset($data['tags'])) {
            $article->tags()->sync($data['tags']);
        }

        return $article->load(['user', 'category', 'tags']);
    }

    public function delete($id)
    {
        $article = $this->model->find($id);

        if (!$article) {
            return false;
        }

        $article->tags()->detach();
        return $article->delete();
    }

    public function getUserArticles($userId)
    {
        return $this->model->with(['user', 'category', 'tags'])
            ->where('user_id', $userId)
            ->get();
    }

    public function getArticles(Request $request): LengthAwarePaginator
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

        return $query->latest()->paginate(9);
    }

    public function getArticleWithRelations(int $id)
    {
        return Article::with(['user', 'categorie', 'tags', 'comments.user', 'ratings.user'])
            ->findOrFail($id);
    }

    public function getSimilarArticles(int $articleId, int $limit = 4)
    {
        return Article::where('id', '!=', $articleId)
            ->with(['user', 'categorie', 'tags'])
            ->take($limit)
            ->get();
    }

    public function createArticle(array $data)
    {
        if (isset($data['image']) && $data['image']) {
            $data['image'] = $data['image']->store('articles', 'public');
        }

        $article = Article::create($data);

        if (isset($data['tags'])) {
            $article->tags()->sync($data['tags']);
        }

        return $article;
    }

    public function updateArticle(int $id, array $data)
    {
        $article = Article::findOrFail($id);

        if (isset($data['image']) && $data['image']) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $data['image']->store('articles', 'public');
        }

        $article->update($data);

        if (isset($data['tags'])) {
            $article->tags()->sync($data['tags']);
        }

        return $article;
    }

    public function deleteArticle(int $id)
    {
        $article = Article::findOrFail($id);

        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();
    }
}
