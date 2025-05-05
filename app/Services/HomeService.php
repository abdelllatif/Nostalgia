<?php

namespace App\Services;

use App\Repositories\Interfaces\HomeRepositoryInterface;

class HomeService
{
    protected $homeRepository;

    public function __construct(HomeRepositoryInterface $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    public function getArticles()
    {
        return $this->homeRepository->getArticles();
    }

    public function getProducts()
    {
        return $this->homeRepository->getProducts();
    }

    public function getTopCategories()
    {
        return $this->homeRepository->getTopCategories();
    }
}
