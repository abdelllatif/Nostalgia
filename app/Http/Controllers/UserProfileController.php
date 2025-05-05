<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Product;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class UserProfileController extends Controller
{
    /**
     * Display the user's profile with all necessary data
     */
    public function index()
    {
        $user = auth()->user();

        // Get unpaid winners for user's products
        $unpaidWinners = Product::where('user_id', $user->id)
            ->where('auction_end_date', '<', now())
            ->whereHas('bids')
            ->whereDoesntHave('payments', function($query) {
                $query->where('status', 'completed');
            })
            ->with(['bids' => function($query) {
                $query->orderBy('amount', 'desc')->take(1);
            }, 'bids.user'])
            ->get()
            ->map(function($product) {
                $highestBid = $product->bids->first();
                if ($highestBid) {
                    $product->winner = $highestBid->user;
                    $product->winning_amount = $highestBid->amount;
                }
                return $product;
            })
            ->filter(function($product) {
                return isset($product->winner);
            });

        // Get statistics
        $statistics = [
            'auctions_won' => Product::whereHas('bids', function($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->whereRaw('amount = (SELECT MAX(amount) FROM bids WHERE product_id = products.id)');
            })->where('auction_end_date', '<', now())->count(),

            'auctions_lost' => Product::whereHas('bids', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('auction_end_date', '<', now())
            ->whereDoesntHave('bids', function($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->whereRaw('amount = (SELECT MAX(amount) FROM bids WHERE product_id = products.id)');
            })->count(),

            'auctions_active' => Product::whereHas('bids', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('auction_end_date', '>', now())->count(),

            'products_listed' => Product::where('user_id', $user->id)->count(),
            'products_sold' => Product::where('user_id', $user->id)
                ->where('auction_end_date', '<', now())
                ->whereHas('payments', function($query) {
                    $query->where('status', 'completed');
                })->count(),
            'products_unsold' => Product::where('user_id', $user->id)
                ->where('auction_end_date', '<', now())
                ->whereDoesntHave('payments', function($query) {
                    $query->where('status', 'completed');
                })->count(),
        ];

        // Get won products
        $wonProducts = Product::whereHas('bids', function($query) use ($user) {
            $query->where('user_id', $user->id)
                ->whereRaw('amount = (SELECT MAX(amount) FROM bids WHERE product_id = products.id)');
        })->where('auction_end_date', '<', now())
        ->with(['bids' => function($query) {
            $query->orderBy('amount', 'desc')->take(1);
        }])
        ->get()
        ->map(function($product) {
            $product->payment_status = $product->payments()
                ->where('status', 'completed')
                ->exists() ? 'paid' : 'unpaid';
            return $product;
        });

        // Get user's articles
        $articles = Article::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Get user's products
        $products = Product::where('user_id', $user->id)
            ->where('status', '!=', 'finished')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Get user's recent activity
        $recentActivity = $this->getRecentActivity($user->id);

        // Get user's reactions (comments and ratings)
        $reactions = $this->getUserReactions($user->id);

        return view('profile', compact(
            'user',
            'statistics',
            'articles',
            'products',
            'wonProducts',
            'recentActivity',
            'reactions',
            'unpaidWinners'
        ));
    }

    /**
     * Update the user's profile information
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'work' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // Convert empty strings to null for optional fields
            $validated['phone'] = $validated['phone'] ?: null;
            $validated['address'] = $validated['address'] ?: null;
            $validated['work'] = $validated['work'] ?: null;
            $validated['education'] = $validated['education'] ?: null;
            $validated['bio'] = $validated['bio'] ?: null;

            if ($request->hasFile('profile_image')) {
                // Delete old image if exists
                if ($user->profile_image) {
                    Storage::disk('public')->delete($user->profile_image);
                }

                $path = $request->file('profile_image')->store('profile_images', 'public');
                $validated['profile_image'] = $path;
            }

            $user->update($validated);

            return back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update profile. Please try again.');
        }
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return back()->with('success', 'Password updated successfully');
    }

    /**
     * Update the user's last active section
     */
    public function updateLastActiveSection(Request $request)
    {
        $validated = $request->validate([
            'last_active_section' => 'required|string'
        ]);

        $user = auth()->user();
        $user->update($validated);

        return response()->json(['success' => true]);
    }

    /**
     * Get recent activity for the user
     */
    private function getRecentActivity($userId)
    {
        // Get recent articles
        $recentArticles = Article::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function($item) {
                return [
                    'type' => 'article',
                    'item' => $item,
                    'date' => $item->created_at
                ];
            });

        // Get recent products
        $recentProducts = Product::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function($item) {
                return [
                    'type' => 'product',
                    'item' => $item,
                    'date' => $item->created_at
                ];
            });

        // Get recent bids
        $recentBids = Bid::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function($item) {
                return [
                    'type' => 'bid',
                    'item' => $item,
                    'date' => $item->created_at
                ];
            });

        // Get won auctions - modified to use max bid amount instead of winning_bid
        $wonAuctions = Product::whereHas('bids', function($query) use ($userId) {
            $query->where('user_id', $userId)
                ->whereRaw('amount = (SELECT MAX(amount) FROM bids WHERE product_id = products.id)');
        })->where('auction_end_date', '<', now())
        ->orderBy('auction_end_date', 'desc')
        ->take(3)
        ->get()
        ->map(function($item) {
            return [
                'type' => 'won_auction',
                'item' => $item,
                'date' => $item->auction_end_date
            ];
        });

        // Get recent reactions
        $reactions = $this->getUserReactions($userId, 3)
            ->map(function($item) {
                return [
                    'type' => 'reaction',
                    'item' => $item,
                    'date' => $item->created_at
                ];
            });

        // Combine and sort all activities
        return collect()
            ->concat($recentArticles)
            ->concat($recentProducts)
            ->concat($recentBids)
            ->concat($wonAuctions)
            ->concat($reactions)
            ->sortByDesc('date')
            ->take(10);
    }

    private function getUserReactions($userId, $limit = 5)
    {
        // Get combined reactions (comments and ratings) for the same article
        $reactions = DB::query()
            ->fromSub(
                DB::table('comments')
                    ->join('articles', 'comments.article_id', '=', 'articles.id')
                    ->where('comments.user_id', $userId)
                    ->select(
                        'comments.article_id',
                        'articles.title as article_title',
                        'comments.content as comment',
                        DB::raw('NULL as rating'),
                        'comments.created_at'
                    )
                    ->union(
                        DB::table('ratings')
                            ->join('articles', 'ratings.article_id', '=', 'articles.id')
                            ->where('ratings.user_id', $userId)
                            ->select(
                                'ratings.article_id',
                                'articles.title as article_title',
                                DB::raw('NULL as comment'),
                                'ratings.rating',
                                'ratings.created_at'
                            )
                    ),
                'combined_reactions'
            )
            ->select(
                'article_id',
                'article_title',
                DB::raw('MAX(comment) as comment'),
                DB::raw('MAX(rating) as rating'),
                DB::raw('MAX(created_at) as created_at')
            )
            ->groupBy('article_id', 'article_title')
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get()
            ->map(function ($reaction) {
                $reaction->created_at = \Carbon\Carbon::parse($reaction->created_at);
                return $reaction;
            });

        return $reactions;
    }

    public function reactions($id)
    {
        $user = User::findOrFail($id);

        // Get combined reactions (comments and ratings) for the same article
        $reactions = DB::query()
            ->fromSub(
                DB::table('comments')
                    ->join('articles', 'comments.article_id', '=', 'articles.id')
                    ->where('comments.user_id', $id)
                    ->select(
                        'comments.article_id',
                        'articles.title as article_title',
                        'comments.content as comment',
                        DB::raw('NULL as rating'),
                        'comments.created_at'
                    )
                    ->union(
                        DB::table('ratings')
                            ->join('articles', 'ratings.article_id', '=', 'articles.id')
                            ->where('ratings.user_id', $id)
                            ->select(
                                'ratings.article_id',
                                'articles.title as article_title',
                                DB::raw('NULL as comment'),
                                'ratings.rating',
                                'ratings.created_at'
                            )
                    ),
                'combined_reactions'
            )
            ->select(
                'article_id',
                'article_title',
                DB::raw('MAX(comment) as comment'),
                DB::raw('MAX(rating) as rating'),
                DB::raw('MAX(created_at) as created_at')
            )
            ->groupBy('article_id', 'article_title')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->through(function ($reaction) {
                $reaction->created_at = \Carbon\Carbon::parse($reaction->created_at);
                return $reaction;
            });

        return view('user_reactions', compact('user', 'reactions'));
    }
}
