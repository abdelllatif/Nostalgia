<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['user', 'bids', 'images'])
            ->withCount('bids')
            ->get()
            ->map(function ($product) {
                $endDate = Carbon::parse($product->auction_end_date);
                $now = Carbon::now();

                if ($endDate->isPast()) {
                    $product->remaining_time = 'Terminé';
                    $product->is_ended = true;
                } else {
                    $product->remaining_time = $endDate->diffForHumans();
                    $product->is_ended = false;
                }

                return $product;
            });

        $stats = [
            'total_products' => Product::count(),
            'active_auctions' => Product::where('status', 'active')
                ->where('auction_end_date', '>', now())
                ->count(),
            'total_bids' => Product::withCount('bids')->get()->sum('bids_count'),
        ];

        return view('Dashebored_products', compact('products', 'stats'));
    }

    public function show($id)
    {
        $product = Product::with(['user', 'bids', 'images'])
            ->withCount('bids')
            ->findOrFail($id);

        $endDate = Carbon::parse($product->auction_end_date);
        $now = Carbon::now();

        if ($endDate->isPast()) {
            $product->remaining_time = 'Terminé';
            $product->is_ended = true;
        } else {
            $product->remaining_time = $endDate->diffForHumans();
            $product->is_ended = false;
        }

        return view('product_details', compact('product'));
    }
}
