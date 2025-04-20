<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Product;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        return view('profile', compact(
            'user',
            'statistics',
            'articles',
            'products',
            'recentActivity'
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
            'profile_image' => 'nullable|image|max:2048'
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile-images', 'public');
            $user->profile_image = $path;
        }

        // Update user fields individually
        $user->education = $validated['education'] ?? $user->education;
        $user->work = $validated['work'] ?? $user->work;
        $user->bio = $validated['bio'] ?? $user->bio;
        $user->last_active_section = $validated['last_active_section'] ?? $user->last_active_section;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully'
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

        return $activities->sortByDesc('date')->take(5);
    }
}
