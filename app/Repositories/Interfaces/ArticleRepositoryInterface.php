<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleRepositoryInterface
{
    public function getArticles(Request $request): LengthAwarePaginator;
    public function getArticleWithRelations(int $id);
    public function getSimilarArticles(int $articleId);
    public function createArticle(array $data);
    public function updateArticle(int $id, array $data);
    public function deleteArticle(int $id);
}
