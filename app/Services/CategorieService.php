<?php

namespace App\Services;

use App\Repositories\Interfaces\CategorieRepositoryInterface;

class CategorieService
{
    protected $categorieRepository;

    public function __construct(CategorieRepositoryInterface $categorieRepository)
    {
        $this->categorieRepository = $categorieRepository;
    }

    public function getAllCategories()
    {
        return $this->categorieRepository->getAllCategories();
    }

    public function findCategorieById($id)
    {
        return $this->categorieRepository->findCategorieById($id);
    }

    public function createCategorie(array $data)
    {
        return $this->categorieRepository->createCategorie($data);
    }

    public function updateCategorie($id, array $data)
    {
        return $this->categorieRepository->updateCategorie($id, $data);
    }

    public function deleteCategorie($id)
    {
        return $this->categorieRepository->deleteCategorie($id);
    }
}
