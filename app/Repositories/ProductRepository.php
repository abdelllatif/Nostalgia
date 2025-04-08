<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll($filterby)
    {
        return Product::with(['category', 'user', 'images', 'tags:id,name'])->orderBy($filterby,'asc')->get();
    }

    public function findById($id)
    {
        return Product::with('category', 'user', 'images', 'tags:id,name')->findOrFail($id);
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
            ->leftJoin('taggables', function ($join) {
                $join->on('products.id', '=', 'taggables.taggable_id')
                    ->where('taggables.taggable_type', '=', 'App\Models\Product');
            })
            ->leftJoin('tags', 'tags.id', '=', 'taggables.tag_id')
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


    public function updateStatus($id, $status)
{
    return Product::where('id', $id)->update(['status' => $status]);
}


    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }
}
