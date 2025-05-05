<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use App\Models\Bid;
use App\Notifications\BidNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BidNotificationService
{
    public function handleNewBid(Product $product, Bid $newBid)
    {
        // Get the previous highest bidder
        $previousHighestBid = $product->bids()
            ->where('id', '!=', $newBid->id)
            ->orderBy('amount', 'desc')
            ->first();

        if ($previousHighestBid) {
            // Notify the previous highest bidder that they've been outbid
            $previousHighestBidder = User::find($previousHighestBid->user_id);
            if ($previousHighestBidder) {
                try {
                    $previousHighestBidder->notify(new BidNotification(
                        'outbid',
                        $product,
                        $newBid->amount
                    ));
                    // Add a small delay to avoid rate limiting
                    sleep(1);
                } catch (\Exception $e) {
                    Log::error("Error sending outbid notification: " . $e->getMessage());
                }
            }
        }
    }

    public function handleAuctionEnd(Product $product)
    {
        $highestBid = $product->bids()->orderBy('amount', 'desc')->first();
        $owner = User::find($product->user_id);

        if ($highestBid) {
            // Notify the winner
            $winner = User::find($highestBid->user_id);
            if ($winner) {
                try {
                    $winner->notify(new BidNotification(
                        'bid_won',
                        $product,
                        $highestBid->amount
                    ));
                    // Add a small delay to avoid rate limiting
                    sleep(1);
                } catch (\Exception $e) {
                    Log::error("Error sending winner notification: " . $e->getMessage());
                }
            }

            // Notify the owner about the winner
            if ($owner) {
                try {
                    $owner->notify(new BidNotification(
                        'auction_ended',
                        $product,
                        $highestBid->amount,
                        $winner
                    ));
                    // Add a small delay to avoid rate limiting
                    sleep(1);
                } catch (\Exception $e) {
                    Log::error("Error sending owner notification: " . $e->getMessage());
                }
            }
        } else {
            // No bids were placed
            if ($owner) {
                try {
                    $owner->notify(new BidNotification(
                        'auction_ended_no_bids',
                        $product
                    ));
                    // Add a small delay to avoid rate limiting
                    sleep(1);
                } catch (\Exception $e) {
                    Log::error("Error sending no bids notification: " . $e->getMessage());
                }
            }
        }
    }
}
