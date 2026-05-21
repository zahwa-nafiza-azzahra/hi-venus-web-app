<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'daily');
        
        $totalRevenue = Order::whereIn('status', ['paid', 'completed'])->sum('total_amount');
        $totalTransactions = Order::whereIn('status', ['paid', 'completed'])->count();
        // Mock conversion rate
        $conversionRate = '3.8';
        
        // Mock sales trends
        $trends = [
            'MON' => ['revenue' => 40, 'orders' => 60],
            'TUE' => ['revenue' => 65, 'orders' => 45],
            'WED' => ['revenue' => 85, 'orders' => 70],
            'THU' => ['revenue' => 55, 'orders' => 80],
            'FRI' => ['revenue' => 95, 'orders' => 90],
            'SAT' => ['revenue' => 70, 'orders' => 65],
            'SUN' => ['revenue' => 30, 'orders' => 40],
        ];

        // Best selling (mocked logic or real if possible, for now real query based on order items)
        // Since we don't have order_items relations ready, let's just pass some top products
        $topProducts = \App\Models\Product::withCount('orderItems')
                            ->orderByDesc('order_items_count')
                            ->take(2)
                            ->get();

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.reports.index', compact('period', 'totalRevenue', 'totalTransactions', 'conversionRate', 'trends', 'topProducts', 'recentOrders'));
    }
}
