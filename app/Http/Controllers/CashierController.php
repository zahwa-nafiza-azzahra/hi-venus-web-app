<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class CashierController extends Controller
{
    public function index()
    {
        $pendingOrders    = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $shippedOrders    = Order::where('status', 'shipped')->count();
        $todayCompleted   = Order::where('status', 'completed')
            ->whereDate('completed_at', today())->count();

        $recentOrders = Order::with(['user', 'items.product'])
            ->whereIn('status', ['pending', 'paid', 'processing'])
            ->latest()->take(5)->get();

        return view('cashier.dashboard', compact(
            'pendingOrders', 'processingOrders', 'shippedOrders',
            'todayCompleted', 'recentOrders'
        ));
    }

    public function catalog()
    {
        $products = Product::with('variants')->get();
        return view('cashier.catalog', compact('products'));
    }

    public function pickup(Request $request)
    {
        $order_number = $request->input('order_number');
        $order = null;

        if ($order_number) {
            $order = Order::with(['user', 'items.product', 'items.variant'])
                ->where('order_number', $order_number)
                ->first();
        }

        return view('cashier.pickup', compact('order', 'order_number'));
    }
    public function receipt() { return view('cashier.receipt'); }
    public function report() { return view('cashier.report'); }

    /** Daftar semua pesanan online */
    public function orders(Request $request)
    {
        $status = $request->get('status', 'all');
        $query  = Order::with(['user', 'items.product', 'items.variant'])->latest();
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        $orders = $query->paginate(15);
        $counts = [
            'all'        => Order::count(),
            'pending'    => Order::where('status', 'pending')->count(),
            'paid'       => Order::where('status', 'paid')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped'    => Order::where('status', 'shipped')->count(),
            'completed'  => Order::where('status', 'completed')->count(),
            'cancelled'  => Order::where('status', 'cancelled')->count(),
        ];
        return view('cashier.orders', compact('orders', 'status', 'counts'));
    }

    /** Detail pesanan */
    public function orderShow($id)
    {
        $order = Order::with(['user', 'items.product', 'items.variant', 'voucher'])->findOrFail($id);
        return view('cashier.order_show', compact('order'));
    }

    /** Update status pesanan */
    public function orderUpdateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'status'          => 'required|in:paid,processing,shipped,completed,cancelled',
            'cashier_note'    => 'nullable|string|max:500',
            'tracking_number' => 'nullable|string|max:100',
        ]);

        $newStatus  = $request->status;
        $timestamps = [];
        if ($newStatus === 'paid'       && !$order->confirmed_at) $timestamps['confirmed_at'] = now();
        if ($newStatus === 'processing' && !$order->processed_at) $timestamps['processed_at'] = now();
        if ($newStatus === 'shipped'    && !$order->shipped_at)   $timestamps['shipped_at']   = now();
        if ($newStatus === 'completed'  && !$order->completed_at) $timestamps['completed_at'] = now();

        $order->update(array_merge([
            'status'          => $newStatus,
            'cashier_note'    => $request->cashier_note,
            'tracking_number' => $request->tracking_number ?? $order->tracking_number,
        ], $timestamps));

        return back()->with('success', "Status pesanan #{$order->order_number} berhasil diubah ke: {$order->fresh()->status_label}");
    }
}
