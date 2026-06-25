<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Halaman POS Kasir Hi Venus.
     * Hanya bisa diakses oleh admin dan kasir.
     */
    public function index()
    {
        $layout = auth()->user()->isCashier() ? 'layouts.cashier' : 'layouts.admin';
        
        $products = \App\Models\Product::with(['category', 'variants'])
            ->where('is_visible', true)
            ->get();
        $categories = \App\Models\Category::all();

        return view('pos.index', compact('layout', 'products', 'categories'));
    }

    /**
     * Checkout POS Kasir
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.variant_id' => 'nullable|exists:product_variants,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'cash_received' => 'required|numeric|min:0',
        ]);

        $items = $request->items;

        \DB::beginTransaction();
        try {
            // Buat order baru
            $order = new \App\Models\Order();
            $order->user_id = auth()->id(); // User yang melakukan transaksi POS adalah kasir/admin
            
            // Format order_number
            $datePrefix = now()->format('ymd');
            $countToday = \App\Models\Order::whereDate('created_at', today())->count() + 1;
            $order->order_number = 'HV-' . $datePrefix . '-' . str_pad($countToday, 4, '0', STR_PAD_LEFT);
            
            $order->recipient_name = 'POS Customer';
            $order->shipping_method = 'Ambil di Toko';
            $order->payment_method = 'CASH';
            
            $subtotal = collect($items)->sum(function($item) {
                return $item['price'] * $item['qty'];
            });
            $tax = $subtotal * 0.11;

            $order->total_amount = $subtotal + $tax;
            
            // Set order as completed directly
            $order->status = 'completed';
            $order->confirmed_at = now();
            $order->processed_at = now();
            $order->shipped_at = now();
            $order->completed_at = now();

            $order->save();

            // Simpan order items dan kurangi stok
            foreach ($items as $item) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'product_variant_id' => $item['variant_id'] ?? null,
                    'quantity' => $item['qty'],
                    'price' => $item['price'],
                ]);

                // Kurangi stok varian jika ada
                if (isset($item['variant_id'])) {
                    $variant = \App\Models\ProductVariant::find($item['variant_id']);
                    if ($variant) {
                        $variant->decrement('stock', $item['qty']);
                    }
                }

                // Tambah total_sold pada produk
                $product = \App\Models\Product::find($item['product_id']);
                if ($product) {
                    $product->increment('total_sold', $item['qty']);
                }
            }

            \DB::commit();

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'message' => 'Checkout berhasil!'
            ]);

        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses transaksi: ' . $e->getMessage()
            ], 500);
        }
    }
}
