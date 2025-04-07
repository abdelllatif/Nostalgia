<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;

use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Article;
use App\Repositories\Interfaces\AdminRepositoryInterface;
class AdminRepository implements AdminRepositoryInterface
{
        public function fetchUsers(array $filters, int $perPage = 15)
        {
            $query = DB::table('users');

            if (!empty($filters['role'])) {
                $query->where('role', $filters['role']);
            }

            if (!empty($filters['status'])) {
                $query->where('status', $filters['status']);
            }

            if (!empty($filters['is_verified'])) {
                $query->where('is_verified', $filters['is_verified']);
            }

            if (!empty($filters['search'])) {
                $search = $filters['search'];
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            }

            return $query->orderByDesc('created_at')->paginate($perPage);
        }

    public function approveUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 'approved';
            $user->save();
            return $user;
        }
        return null;
    }

    public function suspendUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 'suspended';
            $user->save();
            return $user;
        }
        return null;
    }

    public function approveProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->status = 'approved';
            $product->save();
            return $product;
        }
        return null;
    }

    public function suspendProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->status = 'suspended';
            $product->save();
            return $product;
        }
        return null;
    }

    public function approveArticle($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->status = 'approved';
            $article->save();
            return $article;
        }
        return null;
    }

    public function suspendArticle($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->status = 'suspended';
            $article->save();
            return $article;
        }
        return null;
    }

    public function getStatistics()
    {
        return [
            'totalUsers' => User::count(),
            'totalProducts' => Product::count(),
            'totalArticles' => Article::count(),
            'approvedUsers' => User::where('status', 'approved')->count(),
            'suspendedUsers' => User::where('status', 'suspended')->count(),
            'approvedProducts' => Product::where('status', 'approved')->count(),
            'suspendedProducts' => Product::where('status', 'suspended')->count(),
            'approvedArticles' => Article::where('status', 'approved')->count(),
            'suspendedArticles' => Article::where('status', 'suspended')->count(),
        ];
    }
}
