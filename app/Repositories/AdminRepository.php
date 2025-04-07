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

       public function approveUser(int $id)
       {
           return DB::table('users')->where('id', $id)->update(['status' => 'approved']);
       }

       public function suspendUser(int $id)
       {
           return DB::table('users')->where('id', $id)->update(['status' => 'suspended']);
       }

       public function approveProduct(int $id)
       {
           return DB::table('products')->where('id', $id)->update(['status' => 'approved']);
       }

       public function suspendProduct(int $id)
       {
           return DB::table('products')->where('id', $id)->update(['status' => 'suspended']);
       }

       public function approveArticle(int $id)
       {
           return DB::table('articles')->where('id', $id)->update(['status' => 'approved']);
       }

       public function suspendArticle(int $id)
       {
           return DB::table('articles')->where('id', $id)->update(['status' => 'suspended']);
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
