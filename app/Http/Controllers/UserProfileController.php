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

class UserProfileController extends Controller
{
    /**
     * Display the user's profile with all necessary data
     */
    public function index()
    {
        $user = Auth::user();
        $statistics = [
            'articles_count' => Article::where('user_id', $user->id)->count(),
            'products_count' => Product::where('user_id', $user->id)->count(),
            'bids_count' => Bid::where('user_id', $user->id)->count(),
        ];
        $articles = Article::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        $products = Product::where('user_id', $user->id)
            ->where('status', '!=', 'finished')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        $recentActivity = $this->getRecentActivity($user->id);
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
            $validated['phone'] = $validated['phone'] ?: null;
            $validated['address'] = $validated['address'] ?: null;
            $validated['work'] = $validated['work'] ?: null;
            $validated['education'] = $validated['education'] ?: null;
            $validated['bio'] = $validated['bio'] ?: null;

            if ($request->hasFile('profile_image')) {
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
        $recentArticles = Article::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $recentProducts = Product::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $recentBids = Bid::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

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
