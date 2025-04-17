<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // أولاً: التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'article_id' => 'required|integer|exists:articles,id',
            'content' => 'required|string', // like, dislike, etc.
            'rating' => 'required|integer|between:1,5', // تقييم من 1 إلى 5
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }
        $user_id = auth()->user()->id;
        try {
            $reaction = Comment::create([
                'user_id' => $user_id,
                'article_id' => $request->article_id,
                'content' => $request->content,
            ]);

            // إنشاء التقييم
            $rating = Rating::create([
                'user_id' => $user_id,
                'article_id' => $request->article_id,
                'rating' => $request->rating,
            ]);

            // إرجاع الرد بنجاح
            return response()->json(['message' => 'Reaction and Rating added successfully!', 'reaction' => $reaction, 'rating' => $rating], 200);

        } catch (\Exception $e) {
            // في حالة وقوع خطأ
            return response()->json(['message' => 'Failed to add reaction or rating', 'error' => $e->getMessage()], 500);
        }
    }











}
