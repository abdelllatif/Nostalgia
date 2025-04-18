<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|integer|exists:articles,id',
            'rating' => 'required|integer|between:1,5',
            'content' => 'required|string|max:500',
        ]);
        try {
            $rating = Rating::create([
                'user_id' => auth::user()->id,
                'article_id' => $request->article_id,
                'rating' => $request->rating,
            ]);
            $reaction = Comment::create([
                'user_id' => Auth::user()->id,
                'article_id' => $request->article_id,
                'content' => $request->content,
            ]);
            if(!$reaction && !$rating){
                dd('not added');
            }
            return response()->json(['message' => 'Comment and rating added successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add comment or rating', 'error' => $e->getMessage()], 500);
        }
    }








}
