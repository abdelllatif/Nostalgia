<?php
namespace App\Repositories;

use App\Models\Article;
use App\Repositories\Interfaces\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface
{
    protected $model;

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function getAll()
    {
        return $this->model->with(['user', 'category', 'tags'])->get();
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
}
