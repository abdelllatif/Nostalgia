<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardStatsController extends Controller
{
    public function index()
    {
        // Payment Statistics
        $paymentStats = Payment::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Product Payment Status
        $productPaymentStats = Product::select(
            DB::raw("CASE
                WHEN EXISTS (SELECT 1 FROM payments WHERE payments.product_id = products.id AND payments.status = 'completed') THEN 'paid'
                ELSE 'unpaid'
            END as payment_status"),
            DB::raw('count(*) as count')
        )
        ->groupBy('payment_status')
        ->get();

        // Top 4 Products by Payment Amount
        $topProducts = Product::select('products.*', DB::raw('SUM(payments.amount) as total_amount'))
            ->join('payments', 'products.id', '=', 'payments.product_id')
            ->where('payments.status', 'completed')
            ->groupBy('products.id')
            ->orderBy('total_amount', 'desc')
            ->limit(4)
            ->get();

        // Top 3 Active Users
        $topUsers = User::select('users.*')
            ->selectRaw('(SELECT COUNT(*) FROM articles WHERE articles.user_id = users.id) as article_count')
            ->selectRaw('(SELECT COUNT(*) FROM products WHERE products.user_id = users.id) as product_count')
            ->selectRaw('(SELECT COUNT(*) FROM articles WHERE articles.user_id = users.id) +
                        (SELECT COUNT(*) FROM products WHERE products.user_id = users.id) as total_activity')
            ->orderBy('total_activity', 'desc')
            ->limit(3)
            ->get();

        // Monthly Payment Success Rate
        $monthlySuccessRate = Payment::select(
            DB::raw("to_char(created_at, 'YYYY-MM') as month"),
            DB::raw('COUNT(*) as total_payments'),
            DB::raw("SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as successful_payments"),
            DB::raw("(SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END)::float / COUNT(*)) * 100 as success_rate")
        )
        ->where('created_at', '>=', Carbon::now()->subMonths(6))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        return view('dashboard.stats', compact(
            'paymentStats',
            'productPaymentStats',
            'topProducts',
            'topUsers',
            'monthlySuccessRate'
        ));
    }
}
