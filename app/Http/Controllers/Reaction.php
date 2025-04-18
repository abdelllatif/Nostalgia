<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Reaction extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'article_id' => 'required|integer|exists:articles,id',
            'rating' => 'required|integer|between:1,5',
            'content' => 'required|string|max:500',
        ]);
dd($request->all());
        try {
            // Store the rating
            $rating = Rating::create([
                'user_id' => auth::user()->id,  // Authenticated user ID
                'article_id' => $request->article_id,
                'rating' => $request->rating,
            ]);

            // Store the comment/reaction
            $reaction = Reaction::create([
                'user_id' => auth::user()->id,
                'article_id' => $request->article_id,
                'reaction_type' => 'comment',  // Assuming it's a comment
                'content' => $request->content,
            ]);

            // Return success response
            return response()->json(['message' => 'Comment and rating added successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add comment or rating', 'error' => $e->getMessage()], 500);
        }
    }








}
