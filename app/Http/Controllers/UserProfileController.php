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

class UserProfileController extends Controller
{
    /**
     * Display the user's profile with all necessary data
     */
    public function index()
    {
        $user = Auth::user();

        // Get user statistics
        $statistics = [
            'articles_count' => Article::where('user_id', $user->id)->count(),
            'products_count' => Product::where('user_id', $user->id)->count(),
            'bids_count' => Bid::where('user_id', $user->id)->count(),
        ];

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
        $comments = DB::table('comments')
            ->join('articles', 'comments.article_id', '=', 'articles.id')
            ->where('comments.user_id', $user->id)
            ->select(
                'comments.id',
                'comments.content as comment',
                'comments.created_at',
                'comments.article_id',
                'articles.title as article_title',
                DB::raw('NULL as rating')
            );

        $ratings = DB::table('ratings')
            ->join('articles', 'ratings.article_id', '=', 'articles.id')
            ->where('ratings.user_id', $user->id)
            ->select(
                'ratings.id',
                DB::raw('NULL as comment'),
                'ratings.created_at',
                'ratings.article_id',
                'articles.title as article_title',
                'ratings.rating'
            );

        // Combine comments and ratings, grouping by article_id
        $reactions = DB::query()
            ->fromSub(
                $comments->union($ratings),
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
            ->take(5)
            ->get()
            ->map(function ($reaction) {
                $reaction->created_at = \Carbon\Carbon::parse($reaction->created_at);
                return $reaction;
            });

        return view('profile', compact(
            'user',
            'statistics',
            'articles',
            'products',
            'recentActivity',
            'reactions'
        ));
    }

    /**
     * Update the user's profile information
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'education' => 'nullable|string|max:255',
            'work' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'last_active_section' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|max:2048',
            'first_name' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $path = $request->file('profile_image')->store('profile-images', 'public');
            $user->profile_image = $path;
        }

        // Update user fields individually
        $user->education = $validated['education'] ?? $user->education;
        $user->work = $validated['work'] ?? $user->work;
        $user->bio = $validated['bio'] ?? $user->bio;
        $user->last_active_section = $validated['last_active_section'] ?? $user->last_active_section;
        $user->first_name = $validated['first_name'] ?? $user->first_name;
        $user->name = $validated['name'] ?? $user->name;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'image_url' => $user->profile_image ? Storage::url($user->profile_image) : null
        ]);
    }

    /**
     * Update the user's last active section
     */
    public function updateLastActiveSection(Request $request)
    {
        $validated = $request->validate([
            'section' => 'required|string|max:255'
        ]);

        $user = Auth::user();
        $user->last_active_section = $validated['section'];
        $user->save();

        return response()->json([
            'success' => true
        ]);
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
            ->get();

        // Get recent products
        $recentProducts = Product::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Get recent bids
        $recentBids = Bid::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Get recent comments and ratings combined
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
            ->take(3)
            ->get()
            ->map(function ($reaction) {
                $reaction->created_at = \Carbon\Carbon::parse($reaction->created_at);
                return $reaction;
            });

        // Combine and sort by date
        $activities = collect();

        foreach ($recentArticles as $article) {
            $activities->push([
                'type' => 'article',
                'item' => $article,
                'date' => $article->created_at
            ]);
        }

        foreach ($recentProducts as $product) {
            $activities->push([
                'type' => 'product',
                'item' => $product,
                'date' => $product->created_at
            ]);
        }

        foreach ($recentBids as $bid) {
            $activities->push([
                'type' => 'bid',
                'item' => $bid,
                'date' => $bid->created_at
            ]);
        }

        foreach ($reactions as $reaction) {
            $activities->push([
                'type' => 'reaction',
                'item' => $reaction,
                'date' => $reaction->created_at
            ]);
        }

        return $activities->sortByDesc('date')->take(5);
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
