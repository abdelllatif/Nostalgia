<?php

namespace App\Repositories\Interfaces;

use App\Models\Categorie;

interface CategorieRepositoryInterface
{
    public function getAllCategories();
    public function findCategorieById($id);
    public function createCategorie(array $data);
    public function updateCategorie($id, array $data);
    public function deleteCategorie($id);
}
