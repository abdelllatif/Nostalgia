<?php

namespace App\Repositories;

use App\Models\Categorie;
use App\Repositories\Interfaces\CategorieRepositoryInterface;

class CategorieRepository implements CategorieRepositoryInterface
{
    public function getAllCategories()
    {
        return Categorie::all();
    }

    public function findCategorieById($id)
    {
        return Categorie::find($id);
    }

    public function createCategorie(array $data)
    {
        return Categorie::create($data);
    }

    public function updateCategorie($id, array $data)
    {
        $categorie = Categorie::find($id);
        if ($categorie) {
            $categorie->update($data);
            return $categorie;
        }
        return null;
    }

    public function deleteCategorie($id)
    {
        $categorie = Categorie::find($id);
        if ($categorie) {
            $categorie->delete();
            return true;
        }
        return false;
    }
}
