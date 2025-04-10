<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Product;
use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    public function getAllTags()
    {
        $tags = Tag::withCount(['taggables as produits_count' => function($query) {
            $query->where('taggable_type', Product::class);
        }])
        ->withCount(['taggables as articles_count' => function($query) {
            $query->where('taggable_type', Article::class);
        }])
        ->paginate(8);
        foreach ($tags as $tag) {
            $tag->total_count = $tag->produits_count + $tag->articles_count;
        }
                return  $tags;
    }

    public function findTagById($id)
    {
        return Tag::find($id);
    }

    public function createTag(array $data)
    {
        return Tag::create($data);
    }

    public function deleteTag($id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            $tag->delete();
            return true;
        }
        return false;
    }
}
