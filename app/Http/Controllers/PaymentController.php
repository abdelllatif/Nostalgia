<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Product;

class PaymentController extends Controller
{
    public function processPayment(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $charge = Charge::create([
            'amount' => $product->price * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Payment for product: ' . $product->name,
        ]);
        $product->payment_status = 'paid';
        $product->save();
        return redirect()->route('home')->with('success', 'Payment successful!');
    }
}
