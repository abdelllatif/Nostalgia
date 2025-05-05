<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function checkout(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Verify that the current user is the winner
        if (!$product->isWinner(auth()->id())) {
            return redirect()->route('product.details', $product->id)
                ->with('error', 'Vous n\'êtes pas autorisé à effectuer ce paiement.');
        }

        // Calculate current price (highest bid or starting price)
        $currentPrice = $product->bids()->max('amount') ?? $product->starting_price;

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product->title,
                    ],
                    'unit_amount' => $currentPrice * 100, // Convert to cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['product' => $product->getKey()]),
            'cancel_url' => route('payment.cancel', ['product' => $product->getKey()]),
        ]);

        return redirect($session->url);
    }

    public function success(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Update product status to paid
        $product->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return view('payment.success', compact('product'));
    }

    public function failed(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        return view('payment.failed', compact('product'));
    }
}
