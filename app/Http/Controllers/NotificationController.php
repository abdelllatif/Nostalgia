<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function getUnreadCount()
    {
        $user = Auth::user();
        $count = Notification::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subMinutes(5))
            ->count();

        return response()->json(['count' => $count]);
    }

    public function getRecentNotifications()
    {
        $user = Auth::user();

        // Get notifications from the last 5 minutes
        $notifications = Notification::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subMinutes(5))
            ->orderBy('created_at', 'desc')
            ->get();

        // Format the notifications for display
        $formattedNotifications = $notifications->map(function($notification) {
            return [
                'id' => $notification->id,
                'message' => $notification->message,
                'created_at' => $notification->created_at->diffForHumans()
            ];
        });

        return response()->json([
            'notifications' => $formattedNotifications,
            'count' => $notifications->count(),
        ]);
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);

        // Ensure the notification belongs to the authenticated user
        if ($notification->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json(['success' => true]);
    }
}
