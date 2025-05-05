<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Notifications\AuctionEndedNotification;
use App\Notifications\AuctionWonNotification;
use Carbon\Carbon;

class CheckEndedAuctions extends Command
{
    protected $signature = 'auctions:check-ended';
    protected $description = 'Check for ended auctions and send notifications';

    public function handle()
    {
        $endedProducts = Product::where('end_date', '<=', Carbon::now())
            ->where('status', 'active')
            ->get();

        foreach ($endedProducts as $product) {
            // Get the highest bid
            $highestBid = $product->bids()->orderBy('amount', 'desc')->first();

            // Notify the product owner
            $product->user->notify(new AuctionEndedNotification($product, $highestBid ? $highestBid->user : null));

            // If there's a winner, notify them
            if ($highestBid) {
                $highestBid->user->notify(new AuctionWonNotification($product, $highestBid->amount));
            }

            // Update product status
            $product->update(['status' => 'ended']);
        }

        $this->info('Checked ' . $endedProducts->count() . ' ended auctions.');
    }
}
