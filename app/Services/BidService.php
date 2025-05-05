<?php
namespace App\Services;

use App\Repositories\BidRepository;
use App\Models\Bid;
use App\Models\Product;
use App\Notifications\BidOutbidNotification;
use App\Notifications\AuctionWonNotification;
use App\Notifications\AuctionEndedNotification;
use Carbon\Carbon;

class BidService{
protected $bidrepository;

public function __construct(BidRepository $bidrepository)
{
$this->bidrepository=$bidrepository;
}
public function getproductbids($id){
    return $this->bidrepository->getAllbids($id);
}
public function storeaBid($data){
    return $this->bidrepository->addBid($data);
}

public function placeBid(Product $product, $amount, $userId)
{
    $bid = $product->bids()->create([
        'user_id' => $userId,
        'amount' => $amount
    ]);

    // Update product current price
    $product->update(['current_price' => $amount]);

    // Notify previous bidders
    $this->notifyPreviousBidders($product, $bid);

    return $bid;
}

protected function notifyPreviousBidders(Product $product, Bid $newBid)
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

public function checkEndedAuctions()
{
    $endedProducts = Product::where('auction_end_date', '<=', Carbon::now())
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

    return $endedProducts->count();
}

public function getproductbids($productId)
{
    return Bid::where('product_id', $productId)
        ->with('user')
        ->orderBy('amount', 'desc')
        ->get();
}
}
