<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Tag;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
       $tags= $this->tagService->getAllTags();
       foreach ($tags as $tag) {
        $tag->total_count = $tag->products_count + $tag->posts_count;
    }

        return view('Dashebored_tags',compact('tags'));
    }

    public function show($id)
    {
        $tag = $this->tagService->findTagById($id);
        if (!$tag) {
            return response()->json(['message' => 'Tag not found'], 404);
        }
        return back()->with('success','Tag created successfully');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:tags',
        ]);

        $tag = $this->tagService->createTag($validated);
        return back()->with('success','Tag created successfully');
    }

    public function destroy($id)
    {
        $deleted = $this->tagService->deleteTag($id);
        if (!$deleted) {
            return response()->json(['message' => 'Tag not found'], 404);
        }
        return back()->with('success','Tag deleted successfully');
    }

    public function update(Request $request, $id)
    {
        try {
            $tag = Tag::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $tag->name = $request->name;

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($tag->image) {
                    Storage::delete('public/' . $tag->image);
                }

                // Store new image
                $imagePath = $request->file('image')->store('tags', 'public');
                $tag->image = $imagePath;
            }

            $tag->save();

            return redirect()->back()->with('success', 'Tag mis à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour du tag: ' . $e->getMessage());
        }
    }
}
