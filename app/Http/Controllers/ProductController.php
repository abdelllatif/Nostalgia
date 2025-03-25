<?php
namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use  App\Models\Product;
use App\Models\ProductImage;
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
        return response()->json($this->productService->getProductById($id));
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
            'tags' => 'nullable|array', // Validate tags as an array
        'tags.*' => 'exists:tags,id', // Each image should be a valid string (URL or base64)
        ]);

        // Create Product
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
                $product->tags()->attach($request->tags); // Attach tags by their IDs
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
            'user_id' => 'sometimes|exists:users,id',
            'image' => 'sometimes|string'
        ]);

        return response()->json($this->productService->updateProduct($id, $data));
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function GetUserproduct($userId){

        $products = $this->productService->getUserProducts($userId);
            return response()->json($products);

    }
}
