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

        if (!$product->isWinner(auth()->id())) {
            return redirect()->route('product.details', $product->id)
                ->with('error', 'Vous n\'êtes pas autorisé à effectuer ce paiement.');
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $product->current_price * 100,
                    'product_data' => [
                        'name' => $product->name,
                        'description' => $product->description,
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['productId' => $product->id]),
            'cancel_url' => route('payment.failed', ['productId' => $product->id]),
            'metadata' => [
                'product_id' => $product->id,
                'user_id' => auth()->id(),
            ],
        ]);

        return redirect($session->url);
    }

    public function success(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
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
