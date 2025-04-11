<?php
namespace App\Http\Controllers;
use  App\Http\Controllers\TagController;
use  App\Http\Controllers\CategorieController;
use App\Services\ProductService;
use Illuminate\Http\Request;
use  App\Models\Product;
use App\Models\ProductImage;
use App\Services\CategorieService;
use App\Services\TagService;
use Tymon\JWTAuth\Facades\JWTAuth;
use DateTime;
use GrahamCampbell\ResultType\Success;

class ProductController extends Controller
{
    protected $productService;
    protected $tagService;
    protected $categoryService;
    public function __construct(ProductService $productService, TagService $tagService, CategorieService $categoryService)
    {
        $this->productService = $productService;
        $this->tagService = $tagService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $filterBy = $request->filterby ?? 'created_at';
        $products = $this->productService->getAllProducts($filterBy);
        foreach ($products as $product) {
            $product->time_remaining = $this->getTimeRemaining($product);
        }
        $tags = $this->tagService->getAllTags();
        $categories = $this->categoryService->getAllCategories();
        return view('Catalogue', compact('products', 'tags', 'categories'));
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
    if(!$product){
        return 404;
    }
    return   view('product_details',compact('product'));
    }
    public function getTimeRemaining($product)
    {
        $now = new DateTime();
        $endTime = new DateTime($product->auction_end_date);

        if ($now >= $endTime) {
            if ($product->status !== 'termine') {
                $this->productService->updateStatus($product->id, 'termine');
            }
            return 'Terminé';
        }

        $interval = $now->diff($endTime);
        return $interval->format('%a jours, %h heures, %i minutes, %s secondes');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'historical_context' => 'required|string',
                'starting_price' => 'required|numeric',
                'auction_end_date' => 'required|date',
                'category_id' => 'required|exists:categories,id',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'tags' => 'nullable|array',
                'tags.*' => 'exists:tags,id',
            ]);
            $user = JWTAuth::parseToken()->authenticate();
            $product = Product::create([
                'title' => $request->title,
                'description' => $request->description,
                'historical_context' => $request->historical_context,
                'starting_price' => $request->starting_price,
                'auction_end_date' => $request->auction_end_date,
                'category_id' => $request->category_id,
                'user_id' => $user->id,
            ]);
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('product_images', 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                    ]);
                }
            }
            if ($request->has('tags')) {
                $product->tags()->sync($request->tags);
            }

            return redirect()->route('catalogue.show')->with('success', 'Product added successfully');

        } catch (\Exception $e) {
            return redirect()->route('catalogue.show')->with('error', 'Error adding product: ' . $e->getMessage());
        }
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


    public function search($name){
        $products = $this->productService->search($name);
        if(!$products){
        return response()->json([
            'Success'=>false,
            'message'=>'no product found'
        ],404);
        return response()->json([
            'Success'=>true,
            'products'=>$products
        ],200);
        }
    }


}
