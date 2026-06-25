<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Shared logic to build report data for a given period.
     */
    private function buildReportData(string $period): array
    {
        $query = Order::whereIn('status', ['paid', 'completed']);

        $now = Carbon::now();
        if ($period == 'daily') {
            $startDate = $now->copy()->subDays(6)->startOfDay();
            $groupByFormat = '%Y-%m-%d';
        } elseif ($period == 'weekly') {
            $startDate = $now->copy()->subWeeks(4)->startOfWeek();
            $groupByFormat = '%Y-%u';
        } else {
            $startDate = $now->copy()->subMonths(6)->startOfMonth();
            $groupByFormat = '%Y-%m';
        }

        $filteredOrders = clone $query;
        $filteredOrders->where('created_at', '>=', $startDate);

        $totalRevenue       = $filteredOrders->sum('total_amount');
        $totalTransactions  = $filteredOrders->count();

        $totalUsers     = \App\Models\User::count();
        $conversionRate = $totalUsers > 0 ? round(($totalTransactions / $totalUsers) * 100, 1) : 0;

        $ordersData = clone $filteredOrders;
        $ordersData = $ordersData
            ->selectRaw('DATE_FORMAT(created_at, ?) as date_group, SUM(total_amount) as revenue, COUNT(*) as orders_count', [$groupByFormat])
            ->groupBy('date_group')
            ->orderBy('date_group')
            ->get();

        $trends     = [];
        $maxRevenue = $ordersData->max('revenue') ?: 1;

        $iterator  = $startDate->copy();
        $daysCount = $period == 'daily' ? 7 : ($period == 'weekly' ? 5 : 7);

        for ($i = 0; $i < $daysCount; $i++) {
            if ($period == 'daily') {
                $key   = $iterator->format('Y-m-d');
                $label = strtoupper($iterator->format('D'));
                $iterator->addDay();
            } elseif ($period == 'weekly') {
                $key   = $iterator->format('Y-W');
                $label = 'W' . $iterator->format('W');
                $iterator->addWeek();
            } else {
                $key   = $iterator->format('Y-m');
                $label = strtoupper($iterator->format('M'));
                $iterator->addMonth();
            }

            $data   = $ordersData->firstWhere('date_group', $key);
            $revVal = $data ? $data->revenue : 0;
            $ordVal = $data ? $data->orders_count : 0;
            $revPct = $maxRevenue > 0 ? ($revVal / $maxRevenue) * 100 : 0;
            if ($revPct < 10) $revPct = 10;

            $trends[$label] = [
                'revenue'     => $revPct,
                'orders'      => $ordVal,
                'raw_revenue' => $revVal,
            ];
        }

        $topProducts = \App\Models\Product::withCount(['orderItems as order_items_count' => function ($q) use ($startDate) {
            $q->whereHas('order', function ($oq) use ($startDate) {
                $oq->whereIn('status', ['paid', 'completed'])
                   ->where('created_at', '>=', $startDate);
            });
        }])
        ->orderByDesc('order_items_count')
        ->take(5)
        ->get();

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return compact(
            'period', 'startDate', 'totalRevenue', 'totalTransactions',
            'conversionRate', 'trends', 'topProducts', 'recentOrders'
        );
    }

    public function index(Request $request)
    {
        $period = $request->get('period', 'daily');
        $data   = $this->buildReportData($period);

        extract($data);

        return view('admin.reports.index', compact(
            'period', 'totalRevenue', 'totalTransactions',
            'conversionRate', 'trends', 'topProducts', 'recentOrders'
        ));
    }

    /**
     * Export report as PDF (uses barryvdh/laravel-dompdf).
     */
    public function exportPdf(Request $request)
    {
        $period = $request->get('period', 'daily');
        $data   = $this->buildReportData($period);
        extract($data);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.reports.pdf', compact(
            'period', 'startDate', 'totalRevenue', 'totalTransactions',
            'conversionRate', 'trends', 'topProducts', 'recentOrders'
        ))->setPaper('a4', 'landscape');

        return $pdf->download('Hi_Venus_Sales_Report_' . ucfirst($period) . '_' . now()->format('Ymd') . '.pdf');
    }

    /**
     * Export report as Excel (CSV format — no extra packages needed).
     */
    public function exportExcel(Request $request)
    {
        $period = $request->get('period', 'daily');
        $data   = $this->buildReportData($period);
        extract($data);

        $filename = 'Hi_Venus_Sales_Report_' . ucfirst($period) . '_' . now()->format('Ymd') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $callback = function () use ($period, $startDate, $totalRevenue, $totalTransactions, $conversionRate, $trends, $topProducts, $recentOrders) {
            $handle = fopen('php://output', 'w');

            // UTF-8 BOM so Excel opens correctly
            fputs($handle, "\xEF\xBB\xBF");

            // ── Summary ──────────────────────────────────────
            fputcsv($handle, ['HI VENUS — SALES REPORT']);
            fputcsv($handle, ['Period', ucfirst($period)]);
            fputcsv($handle, ['Generated', now()->format('d M Y H:i')]);
            fputcsv($handle, ['']);

            fputcsv($handle, ['SUMMARY']);
            fputcsv($handle, ['Metric', 'Value']);
            fputcsv($handle, ['Total Revenue', 'Rp ' . number_format($totalRevenue, 0, ',', '.')]);
            fputcsv($handle, ['Total Transactions', $totalTransactions]);
            fputcsv($handle, ['Conversion Rate', $conversionRate . '%']);
            fputcsv($handle, ['']);

            // ── Sales Trends ──────────────────────────────────
            fputcsv($handle, ['SALES TRENDS']);
            fputcsv($handle, ['Period Label', 'Revenue (Rp)', 'Orders Count']);
            foreach ($trends as $label => $t) {
                fputcsv($handle, [
                    $label,
                    number_format($t['raw_revenue'], 0, ',', '.'),
                    $t['orders'],
                ]);
            }
            fputcsv($handle, ['']);

            // ── Top Products ──────────────────────────────────
            fputcsv($handle, ['TOP SELLING PRODUCTS']);
            fputcsv($handle, ['Rank', 'Product Name', 'Price (Rp)', 'Units Sold (period)']);
            foreach ($topProducts as $i => $product) {
                fputcsv($handle, [
                    $i + 1,
                    $product->name,
                    number_format($product->price, 0, ',', '.'),
                    $product->order_items_count,
                ]);
            }
            fputcsv($handle, ['']);

            // ── Recent Orders ─────────────────────────────────
            fputcsv($handle, ['RECENT ORDERS']);
            fputcsv($handle, ['Order Number', 'Customer', 'Amount (Rp)', 'Status', 'Date']);
            foreach ($recentOrders as $order) {
                fputcsv($handle, [
                    $order->order_number,
                    $order->user->name ?? 'Guest',
                    number_format($order->total_amount, 0, ',', '.'),
                    strtoupper($order->status),
                    $order->created_at->format('d M Y H:i'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
