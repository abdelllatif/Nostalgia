<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Bid;
use App\Notifications\BidOutbidNotification;

class BidNotificationService
{
    public function handleNewBid(Product $product, Bid $newBid)
    {
        // Get all previous bidders except the current bidder
        $previousBidders = $product->bids()
            ->where('user_id', '!=', $newBid->user_id)
            ->where('amount', '<', $newBid->amount)
            ->with('user')
            ->get()
            ->pluck('user')
            ->unique('id');

        // Notify each previous bidder
        foreach ($previousBidders as $bidder) {
            $bidder->notify(new BidOutbidNotification($product, $newBid->amount));
        }
    }
}
