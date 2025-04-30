<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\Bid;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EndAuctionJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $now = Carbon::now();

        $endedAuctions = Product::where('status', 'active')
            ->where('auction_end_date', '<', $now)
            ->get();

        foreach ($endedAuctions as $product) {
            $highestBid = Bid::where('product_id', $product->id)
                ->orderBy('amount', 'desc')
                ->first();

            if ($highestBid) {
                $product->status = 'sold';
                $product->save();

                $highestBid->status = 'won';
                $highestBid->save();

                Bid::where('product_id', $product->id)
                    ->where('id', '!=', $highestBid->id)
                    ->update(['status' => 'lost']);
            } else {
                $product->status = 'expired';
                $product->save();
            }
        }
    }
}
