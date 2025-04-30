<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Bid;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UpdateAuctionStatus extends Command
{
    protected $signature = 'products:update-auctions';
    protected $description = 'تحديث حالة المنتجات حسب نهاية المزاد.';

    public function handle()
    {
        // Force output to console even in non-interactive mode
        if (!$this->output) {
            $this->output = new \Symfony\Component\Console\Output\ConsoleOutput();
        }

        $this->info('UpdateAuctionStatus command started at: ' . Carbon::now()->toDateTimeString());
        Log::info('UpdateAuctionStatus command started at: ' . Carbon::now()->toDateTimeString());

        // Get raw database time
        $dbTime = DB::select('SELECT NOW() as now')[0]->now;
        $this->info('Database server time: ' . $dbTime);
        Log::info('Database server time: ' . $dbTime);

        // Use raw SQL to find ended auctions
        $endedAuctions = DB::select('
            SELECT p.*
            FROM products p
            WHERE p.status = ?
            AND p.auction_end_date < NOW()
        ', ['active']);

        $this->info('Found ' . count($endedAuctions) . ' ended auctions using raw SQL');
        Log::info('Found ' . count($endedAuctions) . ' ended auctions using raw SQL');

        // Process the auctions
        foreach ($endedAuctions as $productData) {
            $product = Product::find($productData->id);

            if (!$product) {
                continue;
            }

            $this->info('Processing product ID: ' . $product->id . ' with end date: ' . $product->auction_end_date);
            Log::info('Processing product ID: ' . $product->id . ' with end date: ' . $product->auction_end_date);

            $highestBid = Bid::where('product_id', $product->id)
                ->orderBy('amount', 'desc')
                ->first();

            if ($highestBid) {
                // يوجد عرض، المنتج مباع
                $oldStatus = $product->status;
                $product->status = 'sold';
                $product->save();

                $this->info("Product ID: {$product->id} status changed from {$oldStatus} to sold");
                Log::info("Product ID: {$product->id} status changed from {$oldStatus} to sold");

                $highestBid->status = 'won';
                $highestBid->save();

                // جميع العروض الأخرى تخسر
                $lostCount = Bid::where('product_id', $product->id)
                    ->where('id', '!=', $highestBid->id)
                    ->update(['status' => 'lost']);

                $this->info("Updated {$lostCount} other bids to lost status");
                Log::info("Updated {$lostCount} other bids to lost status");
            } else {
                // لا يوجد أي عرض، المنتج منتهي
                $oldStatus = $product->status;
                $product->status = 'expired';
                $product->save();

                $this->info("Product ID: {$product->id} status changed from {$oldStatus} to expired");
                Log::info("Product ID: {$product->id} status changed from {$oldStatus} to expired");
            }
        }

        $this->info('UpdateAuctionStatus command completed');
        Log::info('UpdateAuctionStatus command completed');

        return 0;
    }
}
