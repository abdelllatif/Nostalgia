<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    public function getAllTags()
    {
        return Tag::all();
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
