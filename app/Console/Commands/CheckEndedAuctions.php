<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Services\BidNotificationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CheckEndedAuctions extends Command
{
    protected $signature = 'auctions:check-ended';
    protected $description = 'Check for ended auctions and send notifications';

    protected $bidNotificationService;

    public function __construct(BidNotificationService $bidNotificationService)
    {
        parent::__construct();
        $this->bidNotificationService = $bidNotificationService;
    }

    public function handle()
    {
        $now = Carbon::now();

        // Get all products that have ended but are still active
        $endedProducts = Product::where('auction_end_date', '<=', $now)
            ->where('status', 'active')
            ->get();

        $count = 0;
        foreach ($endedProducts as $product) {
            try {
                // Check if there are any bids
                $hasBids = $product->bids()->exists();

                // Send notifications
                $this->bidNotificationService->handleAuctionEnd($product);

                // Update product status based on whether there are bids
                $product->status = $hasBids ? 'sold' : 'expired';
                $product->save();

                $count++;

                $this->info("Processed ended auction for product: {$product->title} (Status: {$product->status})");
            } catch (\Exception $e) {
                Log::error("Error processing ended auction for product {$product->id}: " . $e->getMessage());
                $this->error("Error processing product {$product->id}: " . $e->getMessage());
            }
        }

        $this->info("Checked {$count} ended auctions");
    }
}
