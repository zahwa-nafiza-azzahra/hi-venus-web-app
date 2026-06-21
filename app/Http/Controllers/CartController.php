<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
     */
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $variant = $request->input('variant', '');
        // Use product ID + variant as unique key so different variants are separate cart items
        $cartKey = $variant ? $id . '_' . \Illuminate\Support\Str::slug($variant) : $id;

        if(isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                "name"     => $product->name,
                "quantity" => 1,
                "price"    => $product->price,
                "image"    => $product->image,
                "variant"  => $variant ?: 'Default',
                "color_hex"=> $request->input('color_hex'),
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', '✨ ' . $product->name . ' telah ditambahkan ke keranjang!');
    }

    /**
     * Update jumlah produk di keranjang.
     */
    public function update(Request $request, $id)
    {
        if($id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', '✨ Keranjang berhasil diperbarui!');
        }
        return redirect()->back();
    }

    /**
     * Hapus produk dari keranjang.
     */
    public function remove($id)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', '✨ Produk berhasil dihapus dari keranjang!');
        }
        return redirect()->back();
    }
}
