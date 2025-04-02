<?php
namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use  App\Models\Product;
use App\Models\ProductImage;
use DateTime;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return response()->json($this->productService->getAllProducts());
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
    if(!$product){
        return response()->json([
            'message' => 'Produit non trouvé'],
            404
        );
    }
    $product['time_remaining'] = $this->getTimeRemaining($product->auction_end_date);
    return response()->json($product);

    }
    public function getTimeRemaining($endtime)
    {
        $now = new DateTime();
        $endTime = new DateTime($endtime);
        if ($now >= $endTime) {
            return 'Terminé';
        }
        $interval = $now->diff($endTime);

        return $interval->format('%a jours, %h heures, %i minutes, %s secondes');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'historical_context' => 'required|string',
            'starting_price' => 'required|numeric',
            'auction_end_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'images' => 'nullable|array',
            'images.*' => 'nullable|string',
            'tags' => 'array',
        'tags.*' => 'exists:tags,id',
        ]);
        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'historical_context' => $request->historical_context,
            'starting_price' => $request->starting_price,
            'auction_end_date' => $request->auction_end_date,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);
            foreach ($request->images as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $image,
                ]);
            }
            if ($request->has('tags')) {
                $product->tags()->sync($request->tags);
            }

        return response()->json([
            'message' => 'Product created successfully!',
            'product' => $product
        ]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes',
            'historical_context' => 'sometimes|string',
            'starting_price' => 'sometimes|numeric',
            'auction_end_date' => 'sometimes|date',
            'category_id' => 'sometimes|exists:categories,id',
            'image' => 'sometimes|string'
        ]);

        return response()->json($this->productService->updateProduct($id, $data));
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function GetUserproduct($userId)
    {
        $products = $this->productService->getUserProducts($userId);
        if ($products->isEmpty()) {
            return response()->json(['message' => 'Aucun produit trouvé'], 404);
        }
        $products = $products->map(function ($product) {
            $product->time_remaining = $this->getTimeRemaining($product->auction_end_date);
            return $product;
        });

        return response()->json($products);
    }



}
