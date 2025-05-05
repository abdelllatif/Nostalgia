<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;
use App\Models\Bid;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAuctionAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Get product ID from route parameter
            $productId = $request->route('product');

            if (!$productId) {
                return redirect()->route('catalogue');
            }

            // Get the product
            $product = Product::find($productId);

            if (!$product) {
                return redirect()->route('catalogue');
            }

            // Check if auction has ended
            $now = Carbon::now()->setTimezone('Africa/Casablanca');
            $auctionEnd = Carbon::parse($product->auction_end_date)->setTimezone('Africa/Casablanca');
            $hasEnded = $now->greaterThanOrEqualTo($auctionEnd);

            // If auction is still active, allow access to everyone
            if (!$hasEnded) {
                return $next($request);
            }

            // For ended auctions, check if user is owner or winner
            $token = $request->cookie('jwt_token');

            if (!$token) {
                return redirect()->route('login');
            }

            try {
                JWTAuth::setToken($token);
                $user = JWTAuth::authenticate();

                if (!$user) {
                    return redirect()->route('login');
                }

                // Check if user is owner or winner
                $isOwner = $user->id === $product->user_id;
                $highestBid = Bid::where('product_id', $product->id)
                    ->orderByDesc('amount')
                    ->first();
                $isWinner = $highestBid && $user->id === $highestBid->user_id;

                if ($isOwner || $isWinner) {
                    return $next($request);
                }

                return redirect()->route('unauthorized');

            } catch (\Exception $e) {
                return redirect()->route('login');
            }

        } catch (\Throwable $e) {
            return redirect()->route('unauthorized');
        }
    }
}
