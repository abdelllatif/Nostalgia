<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Rating;
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
}
