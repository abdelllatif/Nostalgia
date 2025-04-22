<?php

namespace App\Interfaces;

interface ProfileRepositoryInterface
{
    public function getUserProfile($userId);
    public function updateUserProfile($userId, array $data);
    public function updateProfileImage($userId, $imagePath);
    public function getUserArticles($userId);
    public function getUserProducts($userId);
    public function getProfileStatistics($userId);
}
