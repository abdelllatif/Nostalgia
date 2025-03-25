<?php

namespace App\Repositories\Interfaces;

use App\Models\Tag;

interface TagRepositoryInterface
{
    public function getAllTags();
    public function findTagById($id);
    public function createTag(array $data);
    public function deleteTag($id);
}
