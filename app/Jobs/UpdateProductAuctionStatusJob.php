<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\Bid;
use App\Jobs\NotifyWinnerJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
class UpdateProductAuctionStatusJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $products = Product::where('end_date', '<=', now())->where('status', 'active')->get();

        foreach ($products as $product) {
            $highestBid = Bid::where('product_id', $product->id)
                ->orderBy('amount', 'desc')
                ->first();

            if ($highestBid) {
                $product->winner_id = $highestBid->user_id;
                $product->status = 'terminated';
                $product->save();

                // إرسال إشعار للفائز
                NotifyWinnerJob::dispatch($highestBid->user_id, $product->id);
            }
        }
    }
}
