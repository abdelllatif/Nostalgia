<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\Request;

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
        return response()->json($tag);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:tags',
        ]);

        $tag = $this->tagService->createTag($validated);
        return response()->json($tag, 201);
    }

    public function destroy($id)
    {
        $deleted = $this->tagService->deleteTag($id);
        if (!$deleted) {
            return response()->json(['message' => 'Tag not found'], 404);
        }
        return response()->json(['message' => 'Tag deleted successfully']);
    }
}
