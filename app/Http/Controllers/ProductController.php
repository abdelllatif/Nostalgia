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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DateTime;
use GrahamCampbell\ResultType\Success;
use App\Http\Controllers\BidController;
use App\Services\BidService;

class ProductController extends Controller
{
    protected $productService;
    protected $tagService;
    protected $categoryService;
    protected $bidService;
    public function __construct(ProductService $productService, TagService $tagService, CategorieService $categoryService,BidService $bidService)
    {
        $this->productService = $productService;
        $this->tagService = $tagService;
        $this->categoryService = $categoryService;
        $this->bidService = $bidService;

    }

    public function index(Request $request)
    {
        $query = Product::with(['category', 'user', 'images', 'tags:id,name']);

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search by title or description
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Sort products
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('starting_price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('starting_price', 'desc');
                    break;
                case 'ending_soon':
                    $query->orderBy('auction_end_date', 'asc');
                    break;
                case 'newest':
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12);
        $tags = $this->tagService->getAllTags();
        $categories = $this->categoryService->getAllCategories();

        // Check for JWT authentication even on public routes
        $user = null;
        if ($request->hasCookie('jwt_token')) {
            try {
                $token = $request->cookie('jwt_token');
                \Tymon\JWTAuth\Facades\JWTAuth::setToken($token);
                $user = \Tymon\JWTAuth\Facades\JWTAuth::authenticate();
            } catch (\Exception $e) {
                // Log the error but continue without authentication
                \Log::error('JWT Authentication error in public route:', [
                    'error' => $e->getMessage()
                ]);
            }
        }

        // Add the authenticated user to the request for the view
        if ($user) {
            $request->merge(['auth_user' => $user]);
        }

        return view('catalogue', compact('products', 'tags', 'categories', 'user'));
    }
    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        $product->bids = $this->bidService->getproductbids($product->id);  // All bids
        $product->simmilar_product = $this->productService->getSimilarProducts($product->category_id);

        if (!$product) {
            return response('Product not found', 404);
        }

        // Get the first 5 bids
        $firstBids = $product->bids->slice(0, 5);

        return view('product_details', compact('product', 'firstBids'));
    }

    public function fetchActiveProducts()
    {
        return Product::where('status', 'active')->get();
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
            $user = Auth::user();
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
