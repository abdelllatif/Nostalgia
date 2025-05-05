<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleRepositoryInterface
{
    public function getArticles(Request $request): LengthAwarePaginator;
    public function getArticleWithRelations(int $id);
    public function getSimilarArticles(int $articleId, int $limit = 4);
    public function createArticle(array $data);
    public function updateArticle(int $id, array $data);
    public function deleteArticle(int $id);
}
