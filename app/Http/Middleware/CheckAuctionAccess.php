<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;
use App\Models\Bid;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Support\Facades\Log;

class CheckAuctionAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $product = $request->route('product');

            // Get current time information
            $now = Carbon::now();
            $auctionEnd = Carbon::parse($product->auction_end_date);
            $hasEnded = $now->greaterThan($auctionEnd);

            // Add auction status and time info to the request
            $request->attributes->add([
                'auction_status' => $hasEnded ? 'ended' : 'active',
                'time_info' => $hasEnded
                    ? 'ended ' . $auctionEnd->diffForHumans()
                    : $now->diffForHumans($auctionEnd, true) . ' remaining',
            ]);

            // If auction is still active, allow access for everyone
            if (!$hasEnded) {
                return $next($request);
            }

            // For ended auctions, check jwt_token cookie (changed from jwt_auth to match what AuthController sets)
            $token = $request->cookie('jwt_token');

            // Log the token information for debugging
            Log::info('CheckAuctionAccess: Checking token', [
                'has_token' => !empty($token),
                'token_length' => $token ? strlen($token) : 0,
                'all_cookies' => $request->cookies->all()
            ]);

            if (!$token) {
                return response()->json([
                    'message' => 'Authentication required to access ended auctions',
                    'status' => 'token_not_provided'
                ], 401);
            }

            // Manually set the token for JWTAuth to use
            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();

            if (!$user) {
                Log::warning('CheckAuctionAccess: User not found for token');
                return response()->json([
                    'message' => 'User could not be found',
                    'status' => 'user_not_found'
                ], 404);
            }

            $highestBid = Bid::where('product_id', $product->id)
                ->orderByDesc('amount')
                ->first();

            $isOwner = $user->id === $product->user_id;
            $isWinner = $highestBid && $user->id === $highestBid->user_id;

            Log::info('CheckAuctionAccess: Access check', [
                'user_id' => $user->id,
                'is_owner' => $isOwner,
                'is_winner' => $isWinner,
                'product_owner_id' => $product->user_id,
                'highest_bidder_id' => $highestBid ? $highestBid->user_id : null
            ]);

            if ($isOwner || $isWinner) {
                return $next($request);
            }

            return response()->json([
                'message' => 'You do not have access to this ended auction',
                'status' => 'access_denied'
            ], 403);

        } catch (Exception $e) {
            // Log the specific error for debugging
            Log::error('CheckAuctionAccess Exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Return a generic authentication error
            return response()->json([
                'message' => 'Authentication failed or expired',
                'status' => 'authentication_failed'
            ], 401);
        }
    }
}
