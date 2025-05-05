<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Rating;
use App\Models\Article;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReactionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'article_id' => 'required|integer|exists:articles,id',
            'rating' => 'required|integer|between:1,5',
            'content' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $rating = Rating::create([
                'user_id' => Auth::id(),
                'article_id' => $request->article_id,
                'rating' => $request->rating,
            ]);

            $comment = Comment::create([
                'user_id' => Auth::id(),
                'article_id' => $request->article_id,
                'content' => $request->content,
            ]);

            if (!$comment || !$rating) {
                DB::rollBack();
                return response()->json(['message' => 'Failed to add comment or rating'], 500);
            }

            // Create notification for the article owner
            $article = $comment->article;
            if ($article->user_id !== Auth::id()) {  // Don't notify if the author comments on their own article
                Notification::create([
                    'user_id' => $article->user_id,
                    'type' => 'new_comment',
                    'message' => Auth::user()->name . ' commented on your article "' . $article->title . '"',
                    'is_read' => false,
                ]);
            }

            DB::commit();

            // Return the data needed for UI update
            return response()->json([
                'success' => true,
                'message' => 'Comment and rating added successfully!',
                'comment' => $comment->content,
                'rating' => $rating->rating,
                'user' => [
                    'name' => Auth::user()->name,
                    'avatar_url' => Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name)
                ],
                'comment_time' => $comment->created_at->diffForHumans()
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to add comment or rating', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request)
    {
        $ratingId = $request->input('rating');
        $commentId = $request->input('comment');
        $rating = Rating::findOrFail($ratingId);
        $comment = Comment::findOrFail($commentId);
        if ($comment->user_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to delete this reaction.');
        }

        $comment->delete();
        $rating->delete();

        return back()->with('success', 'Reaction deleted successfully.');
    }
}
