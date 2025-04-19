<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'education' => 'nullable|string|max:255',
            'work' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'last_active_section' => 'nullable|string|max:255'
        ]);

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
}
