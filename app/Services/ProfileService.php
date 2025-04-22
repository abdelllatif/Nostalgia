<?php

namespace App\Services;

use App\Interfaces\ProfileRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    protected $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function getUserProfile($userId)
    {
        return $this->profileRepository->getUserProfile($userId);
    }

    public function updateUserProfile($userId, array $data)
    {
        return $this->profileRepository->updateUserProfile($userId, $data);
    }

    public function handleProfileImageUpload($userId, $image)
    {
        if ($image) {
            $path = $image->store('profile-images', 'public');
            return $this->profileRepository->updateProfileImage($userId, $path);
        }
        return null;
    }

    public function getUserArticles($userId)
    {
        return $this->profileRepository->getUserArticles($userId);
    }

    public function getUserProducts($userId)
    {
        return $this->profileRepository->getUserProducts($userId);
    }

    public function getProfileStatistics($userId)
    {
        return $this->profileRepository->getProfileStatistics($userId);
    }
}
