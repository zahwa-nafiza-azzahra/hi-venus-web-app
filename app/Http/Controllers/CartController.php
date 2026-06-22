<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Tampilkan halaman keranjang.
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Tambah produk ke keranjang (Session based).
     * Fix: tambah product_id ke cart, validasi stok sebelum tambah.
     */
    public function add(Request $request, $id)
    {
        $product   = Product::findOrFail($id);
        $cart      = session()->get('cart', []);
        $variant   = $request->input('variant', '');
        $variantId = $request->input('variant_id', null);

        // Cek stok varian
        if ($variantId) {
            $pv = ProductVariant::find($variantId);
            if (!$pv || $pv->stock <= 0) {
                return redirect()->back()->with('error', '😢 Stok habis untuk varian ini!');
            }
            // Hitung qty yang sudah ada di keranjang untuk varian ini
            $tempKey = $id . '_' . Str::slug($variant);
            $inCart  = $cart[$tempKey]['quantity'] ?? 0;
            if ($inCart >= $pv->stock) {
                return redirect()->back()->with('error', '⚠️ Jumlah di keranjang sudah mencapai batas stok (' . $pv->stock . ' pcs).');
            }
        }

        // Key unik per produk+varian agar varian berbeda jadi item terpisah
        $cartKey = $variant ? $id . '_' . Str::slug($variant) : (string) $id;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                'product_id' => (int) $id,
                'name'       => $product->name,
                'quantity'   => 1,
                'price'      => $product->price,
                'image'      => $product->image,
                'variant'    => $variant ?: 'Default',
                'variant_id' => $variantId ? (int) $variantId : null,
                'color_hex'  => $request->input('color_hex'),
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', '✨ ' . $product->name . ' telah ditambahkan ke keranjang!');
    }

    /**
     * Update jumlah produk di keranjang.
     * Fix: validasi stok sebelum update qty.
     */
    public function update(Request $request, $id)
    {
        if ($id && $request->quantity) {
            $cart   = session()->get('cart', []);
            $newQty = (int) $request->quantity;

            if (isset($cart[$id])) {
                // Cek stok jika ada variant_id
                $variantId = $cart[$id]['variant_id'] ?? null;
                if ($variantId) {
                    $pv = ProductVariant::find($variantId);
                    if ($pv && $newQty > $pv->stock) {
                        return redirect()->back()->with('error', '⚠️ Stok tersedia hanya ' . $pv->stock . ' pcs untuk varian ini.');
                    }
                }

                $cart[$id]['quantity'] = $newQty;
                session()->put('cart', $cart);
                session()->flash('success', '✨ Keranjang berhasil diperbarui!');
            }
        }
        return redirect()->back();
    }

    /**
     * Hapus produk dari keranjang.
     */
    public function remove($id)
    {
        if ($id) {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', '✨ Produk berhasil dihapus dari keranjang!');
        }
        return redirect()->back();
    }
}
