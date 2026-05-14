<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman pengiriman.
     */
    public function shipping()
    {
        if (!session('cart') || count(session('cart')) == 0) {
            return redirect()->route('cart.index')->with('error', 'Wah, keranjangmu masih kosong! 🥺');
        }
        return view('checkout.shipping');
    }

    /**
     * Proses pembuatan pesanan.
     */
    public function placeOrder(Request $request)
    {
        $cart = session('cart');
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Wah, keranjangmu masih kosong! 🥺');
        }

        DB::beginTransaction();
        try {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            $total += 15000; // Ongkir flat untuk dummy

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'HV-' . strtoupper(Str::random(8)),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment ?? 'Bank Transfer',
                'notes' => 'Pesanan dari checkout UI',
            ]);

            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();
            
            // Clear cart
            session()->forget('cart');

            return redirect()->route('orders.index')->with('success', '✨ Pesanan ' . $order->order_number . ' berhasil dibuat! Silakan lakukan pembayaran.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Duh, terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
