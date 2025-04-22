<?php

namespace App\Repositories;

use App\Interfaces\ProfileRepositoryInterface;
use App\Models\User;
use App\Models\Article;
use App\Models\Product;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function getUserProfile($userId)
    {
        return User::with(['articles', 'products'])->findOrFail($userId);
    }

    public function updateUserProfile($userId, array $data)
    {
        $user = User::findOrFail($userId);
        $user->update($data);
        return $user;
    }

    public function updateProfileImage($userId, $imagePath)
    {
        $user = User::findOrFail($userId);
        $user->profile_image = $imagePath;
        $user->save();
        return $user;
    }

    public function getUserArticles($userId)
    {
        return Article::where('user_id', $userId)->latest()->get();
    }

    public function getUserProducts($userId)
    {
        return Product::where('user_id', $userId)->latest()->get();
    }

    public function getProfileStatistics($userId)
    {
        $articlesCount = Article::where('user_id', $userId)->count();
        $productsCount = Product::where('user_id', $userId)->count();
        
        return [
            'articles_count' => $articlesCount,
            'products_count' => $productsCount,
        ];
    }
}
