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
        $period = $request->get('period', 'daily'); // daily, weekly, monthly
        
        $query = Order::whereIn('status', ['paid', 'completed']);
        
        // Define date range based on period
        $now = Carbon::now();
        if ($period == 'daily') {
            $startDate = $now->copy()->subDays(6)->startOfDay(); // last 7 days
            $groupByFormat = '%Y-%m-%d';
        } elseif ($period == 'weekly') {
            $startDate = $now->copy()->subWeeks(4)->startOfWeek(); // last 5 weeks
            $groupByFormat = '%Y-%u';
        } else {
            $startDate = $now->copy()->subMonths(6)->startOfMonth(); // last 7 months
            $groupByFormat = '%Y-%m';
        }

        $filteredOrders = clone $query;
        $filteredOrders->where('created_at', '>=', $startDate);

        $totalRevenue = $filteredOrders->sum('total_amount');
        $totalTransactions = $filteredOrders->count();
        
        // Real conversion rate (Orders / Total Users * 100)
        $totalUsers = \App\Models\User::count();
        $conversionRate = $totalUsers > 0 ? round(($totalTransactions / $totalUsers) * 100, 1) : 0;
        
        // Real sales trends
        $ordersData = clone $filteredOrders;
        $ordersData = $ordersData->selectRaw('DATE_FORMAT(created_at, ?) as date_group, SUM(total_amount) as revenue, COUNT(*) as orders_count', [$groupByFormat])
            ->groupBy('date_group')
            ->orderBy('date_group')
            ->get();
            
        $trends = [];
        $maxRevenue = $ordersData->max('revenue') ?: 1;

        // Fill data based on period
        $iterator = $startDate->copy();
        $daysCount = $period == 'daily' ? 7 : ($period == 'weekly' ? 5 : 7);
        
        for ($i = 0; $i < $daysCount; $i++) {
            $key = '';
            if ($period == 'daily') {
                $key = $iterator->format('Y-m-d');
                $label = strtoupper($iterator->format('D'));
                $iterator->addDay();
            } elseif ($period == 'weekly') {
                $key = $iterator->format('Y-W');
                $label = 'W'.$iterator->format('W');
                $iterator->addWeek();
            } else {
                $key = $iterator->format('Y-m');
                $label = strtoupper($iterator->format('M'));
                $iterator->addMonth();
            }
            
            // Find data
            $data = $ordersData->firstWhere('date_group', $key);
            
            $revVal = $data ? $data->revenue : 0;
            $ordVal = $data ? $data->orders_count : 0;
            
            // Calculate percentage height for UI (0-100)
            $revPct = $maxRevenue > 0 ? ($revVal / $maxRevenue) * 100 : 0;
            if($revPct < 10) $revPct = 10; // Minimum height for UI visibility
            
            $trends[$label] = [
                'revenue' => $revPct,
                'orders' => $ordVal,
                'raw_revenue' => $revVal
            ];
        }

        // Best selling (Real query based on order items)
        $topProducts = \App\Models\Product::withCount(['orderItems as order_items_count' => function ($q) use ($startDate) {
                                $q->whereHas('order', function($oq) use ($startDate) {
                                    $oq->whereIn('status', ['paid', 'completed'])
                                       ->where('created_at', '>=', $startDate);
                                });
                            }])
                            ->orderByDesc('order_items_count')
                            ->take(5)
                            ->get();

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.reports.index', compact('period', 'totalRevenue', 'totalTransactions', 'conversionRate', 'trends', 'topProducts', 'recentOrders'));
    }
}
