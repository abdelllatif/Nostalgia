<?php

namespace App\Repositories\Interfaces;

interface HomeRepositoryInterface
{
    public function getArticles();
    public function getProducts();
    public function getTopCategories();
}
