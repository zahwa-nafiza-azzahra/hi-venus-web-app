<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Voucher;
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

    public function applyVoucher(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        
        $voucher = Voucher::where('code', strtoupper($request->code))
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('start_date')->orWhere('start_date', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->first();

        if (!$voucher) {
            return redirect()->back()->with('error', 'Kode voucher tidak valid atau sudah kedaluwarsa.');
        }

        if ($voucher->quota !== null && $voucher->quota_used >= $voucher->quota) {
            return redirect()->back()->with('error', 'Kuota voucher sudah habis.');
        }

        $cartTotal = collect(session('cart'))->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        if ($voucher->min_spend !== null && $cartTotal < $voucher->min_spend) {
            return redirect()->back()->with('error', 'Minimal belanja belum terpenuhi (Rp ' . number_format($voucher->min_spend, 0, ',', '.') . ').');
        }

        session(['voucher' => $voucher->toArray()]);
        return redirect()->back()->with('success', 'Voucher berhasil digunakan! ✨');
    }

    public function removeVoucher()
    {
        session()->forget('voucher');
        return redirect()->back()->with('success', 'Voucher dilepas.');
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

            // Hitung Ongkir
            $shippingMethod = $request->shipping ?? 'jnt'; // Default
            $shippingCost = 15000;
            if ($shippingMethod == 'pickup') {
                $shippingCost = 0;
                $shippingMethod = 'Ambil di Toko';
            } elseif ($shippingMethod == 'jnt') {
                $shippingCost = 15000;
                $shippingMethod = 'J&T Express';
            } elseif ($shippingMethod == 'jne') {
                $shippingCost = 18000;
                $shippingMethod = 'JNE Reguler';
            } elseif ($shippingMethod == 'sicepat') {
                $shippingCost = 12000;
                $shippingMethod = 'SiCepat Halu';
            }

            // Hitung Voucher
            $voucher = session('voucher');
            $discountAmount = 0;
            
            if ($voucher) {
                // Double check if valid
                $v = Voucher::find($voucher['id']);
                if ($v && $v->is_active && ($v->quota === null || $v->quota_used < $v->quota)) {
                    if ($v->type == 'percentage') {
                        $discountAmount = $total * ($v->value / 100);
                    } elseif ($v->type == 'fixed') {
                        $discountAmount = $v->value;
                    } elseif ($v->type == 'free_shipping') {
                        $discountAmount = $shippingCost;
                    }
                    
                    if ($discountAmount > $total + $shippingCost) {
                        $discountAmount = $total + $shippingCost;
                    }

                    // Tambah quota_used
                    $v->increment('quota_used');
                } else {
                    $voucher = null; // invalid
                }
            }

            $finalTotal = ($total + $shippingCost) - $discountAmount;

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'HV-' . strtoupper(Str::random(8)),
                'total_amount' => $finalTotal,
                'status' => 'pending',
                'payment_method' => $request->payment ?? 'Bank Transfer',
                'shipping_method' => $shippingMethod,
                'shipping_cost' => $shippingCost,
                'voucher_id' => $voucher ? $voucher['id'] : null,
                'discount_amount' => $discountAmount,
                'notes' => 'Pesanan dari checkout UI',
            ]);

            foreach ($cart as $id => $item) {
                $productId = strpos($id, '_') !== false ? explode('_', $id)[0] : $id;
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'] ?? $productId,
                    'product_variant_id' => $item['variant_id'] ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();
            
            // Clear cart and voucher
            session()->forget('cart');
            session()->forget('voucher');

            return redirect()->route('orders.index')->with('success', '✨ Pesanan ' . $order->order_number . ' berhasil dibuat! Silakan lakukan pembayaran.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Duh, terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
