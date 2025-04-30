<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Payment;
use App\Models\Bid;
use App\Models\Notification;
use App\Models\RecentActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create($product_id)
    {
        $product = Product::findOrFail($product_id);

        // Check if auction has ended
        if (!$product->auction_end_date->isPast()) {
            return redirect()->route('product.details', $product->id)
                ->with('error', 'Cette enchère n\'est pas encore terminée.');
        }

        // Get the highest bid
        $highestBid = Bid::where('product_id', $product->id)
            ->orderBy('amount', 'desc')
            ->first();

        // Check if user is the winner
        if (!$highestBid || Auth::id() !== $highestBid->user_id) {
            return redirect()->route('unauthorized');
        }

        // Check if payment already exists and was successful
        $existingPayment = Payment::where('product_id', $product->id)
            ->where('status', 'completed')
            ->first();

        if ($existingPayment) {
            return redirect()->route('product.details', $product->id)
                ->with('error', 'Ce produit a déjà été payé.');
        }

        return view('payments.create', compact('product', 'highestBid'));
    }

    /**
     * Store a newly created payment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:paypal,credit_card'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if auction has ended
        if (!$product->auction_end_date->isPast()) {
            return redirect()->route('product.details', $product->id)
                ->with('error', 'Cette enchère n\'est pas encore terminée.');
        }

        // Get the highest bid
        $highestBid = Bid::where('product_id', $product->id)
            ->orderBy('amount', 'desc')
            ->first();

        // Check if user is the winner
        if (!$highestBid || Auth::id() !== $highestBid->user_id) {
            return redirect()->route('unauthorized');
        }

        // Check for existing payment
        $existingPayment = Payment::where('product_id', $product->id)->first();

        if ($existingPayment) {
            if ($existingPayment->status === 'completed') {
                return redirect()->route('product.details', $product->id)
                    ->with('error', 'Ce produit a déjà été payé.');
            }

            // Update existing payment
            $existingPayment->update([
                'attempts' => $existingPayment->attempts + 1,
                'payment_method' => $request->payment_method,
                'status' => 'pending'
            ]);

            $payment = $existingPayment;
        } else {
            // Create new payment record
            $payment = Payment::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'amount' => $highestBid->amount,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'attempts' => 1,
                'paypal_transaction_id' => 'PP-' . uniqid() // This would be replaced with actual PayPal transaction ID
            ]);
        }

        // Update product status
        $product->status = 'sold';
        $product->save();

        // Update bid status
        $highestBid->status = 'won';
        $highestBid->save();

        // Update other bids to lost
        Bid::where('product_id', $product->id)
            ->where('id', '!=', $highestBid->id)
            ->update(['status' => 'lost']);

        return redirect()->route('product.details', $product->id)
            ->with('success', 'Paiement effectué avec succès. Merci pour votre achat!');
    }

    public function checkout(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Get the highest bid for this product
        $highestBid = Bid::where('product_id', $product->id)
            ->orderBy('amount', 'desc')
            ->first();

        // Check if user is the winner
        if (!$highestBid || Auth::id() !== $highestBid->user_id) {
            return redirect()->route('product.details', $product->id)
                ->with('error', 'Vous n\'êtes pas autorisé à effectuer ce paiement.');
        }

        // Check if payment already exists and was successful
        $existingPayment = Payment::where('product_id', $product->id)
            ->where('status', 'completed')
            ->first();

        if ($existingPayment) {
            return redirect()->route('product.details', $product->id)
                ->with('error', 'Ce produit a déjà été payé.');
        }

        // Create or update payment record
        $payment = Payment::updateOrCreate(
            ['product_id' => $product->id],
            [
                'user_id' => Auth::id(),
                'amount' => $highestBid->amount,
                'status' => 'pending',
                'payment_method' => 'credit_card',
                'attempts' => \Illuminate\Support\Facades\DB::raw('COALESCE(attempts, 0) + 1')
            ]
        );

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $highestBid->amount * 100,
                    'product_data' => array_merge([
                        'name' => $product->title,
                        'description' => $product->description,
                    ], $product->image_url ? ['images' => [$product->image_url]] : []),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['productId' => $productId]),
            'cancel_url' => route('payment.failed', ['productId' => $productId]),
            'metadata' => [
                'product_id' => $product->id,
                'bid_id' => $highestBid->id,
                'user_id' => Auth::id(),
                'payment_id' => $payment->id
            ],
        ]);

        return redirect($session->url);
    }

    public function success($productId)
    {
        $product = Product::findOrFail($productId);
        $highestBid = Bid::where('product_id', $product->id)
            ->orderBy('amount', 'desc')
            ->first();

        // Create or update payment record
        $payment = Payment::updateOrCreate(
            ['product_id' => $product->id],
            [
                'user_id' => Auth::id(),
                'amount' => $highestBid->amount,
                'status' => 'completed',
                'payment_date' => now(),
                'payment_method' => 'credit_card'
            ]
        );

        // Update product status
        $product->status = 'sold';
        $product->save();

        // Create notification for the seller
        Notification::create([
            'user_id' => $product->user_id,
            'type' => 'payment_success',
            'message' => 'Le paiement pour votre produit "' . $product->title . '" a été effectué avec succès.',
            'read' => false,
        ]);

        // Add to recent activities
        RecentActivity::create([
            'user_id' => Auth::id(),
            'type' => 'payment_success',
            'description' => 'Vous avez effectué le paiement pour "' . $product->title . '"',
            'product_id' => $product->id,
        ]);

        return view('payment.success', compact('product'));
    }

    public function failed($productId)
    {
        $product = Product::findOrFail($productId);
        $highestBid = Bid::where('product_id', $product->id)
            ->orderBy('amount', 'desc')
            ->first();

        // Create or update payment record
        $payment = Payment::updateOrCreate(
            ['product_id' => $product->id],
            [
                'user_id' => Auth::id(),
                'amount' => $highestBid->amount,
                'status' => 'failed',
                'payment_date' => now(),
                'payment_method' => 'credit_card',
                'last_error' => 'Payment was cancelled or failed'
            ]
        );

        // Create notification for the buyer
        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'payment_failed',
            'message' => 'Le paiement pour "' . $product->title . '" a échoué. Veuillez réessayer.',
            'read' => false,
        ]);

        return view('payment.failed', compact('product'));
    }
}
