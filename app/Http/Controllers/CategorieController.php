<?php

namespace App\Http\Controllers;

use App\Services\CategorieService;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    protected $categorieService;

    public function __construct(CategorieService $categorieService)
    {
        $this->categorieService = $categorieService;
    }

    public function index()
    {
        return response()->json($this->categorieService->getAllCategories());
    }

    public function show($id)
    {
        $categorie = $this->categorieService->findCategorieById($id);
        if (!$categorie) {
            return response()->json(['message' => 'Categorie not found'], 404);
        }
        return response()->json($categorie);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories',
        ]);

        $categorie = $this->categorieService->createCategorie($validated);
        return response()->json($categorie, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|unique:categories,name,' . $id,
        ]);

        $categorie = $this->categorieService->updateCategorie($id, $validated);
        if (!$categorie) {
            return response()->json(['message' => 'Categorie not found'], 404);
        }

        return response()->json($categorie);
    }

    public function destroy($id)
    {
        $deleted = $this->categorieService->deleteCategorie($id);
        if (!$deleted) {
            return response()->json(['message' => 'Categorie not found'], 404);
        }
        return response()->json(['message' => 'Categorie deleted successfully']);
    }
}
