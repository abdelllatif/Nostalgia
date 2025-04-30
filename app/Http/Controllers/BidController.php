<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Services\BidService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\AuctionUpdated;
use App\Models\Product;

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
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if auction has ended
        if ($product->auction_end_date->isPast()) {
            return back()->with('error', 'Cette enchère est terminée.');
        }

        $currentPrice = $product->bids->isNotEmpty() ? $product->bids->max('amount') : $product->starting_price;

        // Check if bid amount is greater than current price
        if ($request->amount <= $currentPrice) {
            return back()->with('error', 'Le montant de l\'enchère doit être supérieur au prix actuel de ' . number_format($currentPrice, 2) . ' €.');
        }

        // Check if user is not bidding on their own product
        if ($product->user_id === $request->user()->id) {
            return back()->with('error', 'Vous ne pouvez pas enchérir sur votre propre produit.');
        }

        // Create the bid
        $bid = Bid::create([
            'amount' => $request->amount,
            'product_id' => $request->product_id,
            'user_id' => $request->user()->id
        ]);

        // Update product status if needed
        if ($product->status === 'active') {
            $product->status = 'active';
            $product->save();
        }

        return back()->with('success', 'Votre enchère de ' . number_format($request->amount, 2) . ' € a été placée avec succès.');
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
