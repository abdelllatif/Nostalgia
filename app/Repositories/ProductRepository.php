<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::with('category', 'user', 'images')->get();
    }

    public function findById($id)
    {
        return Product::with('category', 'user', 'images')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }
    public function getUserProduct($userId){
        $products = DB::table('users')
            ->join('products', 'users.id', '=', 'products.user_id')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('taggable', function ($join) {
                $join->on('products.id', '=', 'taggable.taggable_id')
                    ->where('taggable.taggable_type', '=', 'App\Models\Product');
            })
            ->leftJoin('tags', 'tags.id', '=', 'taggable.tag_id')
            ->select(
                'products.*',
                'users.name as user_name',
                'categories.name as category_name',
                DB::raw('STRING_AGG(DISTINCT product_images.image_path, \',\') as images'),
                DB::raw('STRING_AGG(DISTINCT tags.name, \',\') as tags'),
                DB::raw('COUNT(products.id) OVER() as products_counter')
            )
            ->where('users.id', $userId)
            ->groupBy('products.id', 'users.name', 'categories.name')
            ->get();
        foreach ($products as $product) {
            $product->images = explode(',', $product->images);
            $product->tags = explode(',', $product->tags);
        }

        return $products;
    }


    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }
}
