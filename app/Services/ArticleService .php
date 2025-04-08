<?php

namespace App\Services;

use App\Repositories\Interfaces\ArticleRepositoryInterface;

class ArticleService
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getAllArticles($filterby)
    {
        return $this->articleRepository->getAll($filterby);
    }

    public function findArticleById($id)
    {
        return $this->articleRepository->findById($id);
    }

    public function createArticle(array $data)
    {
        return $this->articleRepository->create($data);
    }

    public function updateArticle($id, array $data)
    {
        return $this->articleRepository->update($id, $data);
    }

    public function deleteArticle($id)
    {
        return $this->articleRepository->delete($id);
    }

    public function getUserArticles($userId)
    {
        return $this->articleRepository->getUserArticles($userId);
    }
}
