<?php

namespace App\Services;

use App\Repositories\Interfaces\TagRepositoryInterface;

class TagService
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAllTags()
    {
        return $this->tagRepository->getAllTags();
    }

    public function findTagById($id)
    {
        return $this->tagRepository->findTagById($id);
    }

    public function createTag(array $data)
    {
        return $this->tagRepository->createTag($data);
    }

    public function deleteTag($id)
    {
        return $this->tagRepository->deleteTag($id);
    }
}
