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
use App\Models\Bid;
use App\Services\BidService;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Services\BidNotificationService;

class ProductController extends Controller
{
    protected $productService;
    protected $tagService;
    protected $categoryService;
    protected $bidService;
    protected $bidNotificationService;
    public function __construct(ProductService $productService, TagService $tagService, CategorieService $categoryService,BidService $bidService, BidNotificationService $bidNotificationService)
    {
        $this->productService = $productService;
        $this->tagService = $tagService;
        $this->categoryService = $categoryService;
        $this->bidService = $bidService;
        $this->bidNotificationService = $bidNotificationService;
    }
//->where('products.status','=','active')
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

    $products = $query->paginate(9);
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
        if (!$product) {
            return redirect()->route('404');
        }

        $product->bids = $this->bidService->getproductbids($product->id);
        $product->simmilar_product = $this->productService->getSimilarProducts($product->category_id);
        $firstBids = $product->bids->sortByDesc('amount')->take(5);

        // Check for JWT authentication
        $auth_user = null;
        try {
            if (request()->hasCookie('jwt_token')) {
                $token = request()->cookie('jwt_token');
                JWTAuth::setToken($token);
                $auth_user = JWTAuth::authenticate();
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('JWT Authentication error:', ['error' => $e->getMessage()]);
        }

        // Get user role and ticket status
        $userRole = 'visitor';
        $ticketStatus = null;
        $isWinner = false;
        $hasPaid = false;

        if ($auth_user) {
            // Check if user is the owner
            if ($product->user_id === $auth_user->id) {
                $userRole = 'owner';
            } else {
                // Check if user is the winner by finding the highest bid
                $highestBid = $product->bids->sortByDesc('amount')->first();
                if ($highestBid && $highestBid->user_id === $auth_user->id) {
                    $userRole = 'winner';
                    $isWinner = true;

                    // Check payment status
                    $payment = \App\Models\Payment::where('product_id', $product->id)
                        ->where('user_id', $auth_user->id)
                        ->where('status', 'completed')
                        ->first();

                    if ($payment) {
                        $hasPaid = true;
                        // Check if ticket was generated
                        $ticketPath = storage_path('app/public/tickets/ticket_' . $payment->id . '_*.pdf');
                        $ticketExists = !empty(glob($ticketPath));

                        $ticketStatus = [
                            'payment_completed' => true,
                            'ticket_generated' => $ticketExists
                        ];
                    }
                }
            }
        }

        return view('product_details', compact(
            'product',
            'firstBids',
            'auth_user',
            'userRole',
            'ticketStatus',
            'isWinner',
            'hasPaid'
        ));
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

            return back()->with('success', 'Product added successfully');

        } catch (\Exception $e) {
            return back()->with('error', 'Error adding product: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        $isbids=Bid::where('product_id',$id)->exists();
        if(!$isbids){
            return back()->with('error','you cant update this product because he alredy has bids');
        }
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes',
            'historical_context' => 'sometimes|string',
            'starting_price' => 'sometimes|numeric',
            'auction_end_date' => 'sometimes|date',
            'category_id' => 'sometimes|exists:categories,id',
            'image' => 'sometimes|string'
        ]);
        $product=Product::find($id);
        if(!$product){
            return back()->with('error','product not found');
        }
        $product->update($data);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('product_images', 'public');
            $product->images()->update(['image_path' => $path]);
        }
        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        }
        return back()->with('sucsess','product updated suucssfully');
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

    public function placeBid(Request $request, Product $product)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:' . ($product->current_price + 1)
        ]);

        $bid = $this->bidService->placeBid($product, $validated['amount'], auth()->id());

        return response()->json([
            'message' => 'Bid placed successfully',
            'bid' => $bid
        ]);
    }

}
