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
      $categories=$this->categorieService->getAllCategories();
      return view('Dashebored_categories',compact('categories'));

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
        'categoryImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    if ($request->hasFile('categoryImage')) {
        $path = $request->file('categoryImage')->store('categories_image', 'public');
        $validated['image'] = $path;
    }

    $categorie = $this->categorieService->createCategorie($validated);

    if (!$categorie) {
        return redirect()->route('categories.show')->with('error', 'Categorie not registered');
    }

    return redirect()->route('categories.show')->with('success', 'Categorie registered successfully');
}

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|unique:categories,name,' . $id,
            'categoryImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('categoryImage')) {
            $path = $request->file('categoryImage')->store('categories_image', 'public');
            $validated['image'] = $path;
        }

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
