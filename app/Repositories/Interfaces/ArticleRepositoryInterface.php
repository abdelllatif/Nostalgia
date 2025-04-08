<?php

namespace App\Repositories\Interfaces;

interface ArticleRepositoryInterface
{
    public function getAll($filterby);
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getUserArticles($userId);
}
