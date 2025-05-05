<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Services\BidService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\AuctionUpdated;
use App\Models\Product;
use App\Services\BidNotificationService;
use App\Notifications\BidNotification;

class BidController extends Controller
{
    protected $bidservice;
    protected $productController;

    public function __construct(BidService $bidService, ProductController $productController)
    {
        $this->bidservice = $bidService;
        $this->productController = $productController;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $userId = Auth::id();

        // Calculate current price (highest bid or starting price)
        $currentPrice = $product->bids()->max('amount') ?? $product->starting_price;

        $validated = $request->validate([
            'amount' => 'required|numeric|min:' . ($currentPrice + 1)
        ]);

        try {
            $bid = Bid::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'amount' => $validated['amount']
            ]);

            // Notify previous highest bidder if exists
            $previousHighestBid = $product->bids()
                ->where('id', '!=', $bid->id)
                ->orderBy('amount', 'desc')
                ->first();

            if ($previousHighestBid) {
                $previousHighestBidder = $previousHighestBid->user;
                if ($previousHighestBidder && $previousHighestBidder->id !== $userId) {
                    $previousHighestBidder->notify(new BidNotification('outbid', $product, $validated['amount']));
                }
            }

            return redirect()->back()->with('success', 'Votre enchère a été placée avec succès!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors du placement de votre enchère.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($bidId)
    {
        return $this->bidservice->getproductbids($bidId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bid $bid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bid $bid)
    {
        //
    }
}
