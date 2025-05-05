<?php

namespace App\Services;

use App\Repositories\Interfaces\ArticleRepositoryInterface;
use Illuminate\Http\Request;

class ArticleService
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getArticles(Request $request)
    {
        return $this->articleRepository->getArticles($request);
    }

    public function getArticleWithRelations(int $id)
    {
        return $this->articleRepository->getArticleWithRelations($id);
    }

    public function getSimilarArticles(int $articleId, int $limit = 4)
    {
        return $this->articleRepository->getSimilarArticles($articleId, $limit);
    }

    public function createArticle(array $data)
    {
        return $this->articleRepository->createArticle($data);
    }

    public function updateArticle(int $id, array $data)
    {
        return $this->articleRepository->updateArticle($id, $data);
    }

    public function deleteArticle(int $id)
    {
        return $this->articleRepository->deleteArticle($id);
    }
}
