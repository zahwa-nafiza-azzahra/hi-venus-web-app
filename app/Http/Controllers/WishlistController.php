<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Tampilkan halaman wishlist user.
     */
    public function index()
    {
        $wishlists = Wishlist::where('user_id', auth()->id())->with('product')->get();
        return view('wishlist', compact('wishlists'));
    }

    /**
     * Tambah/Hapus dari wishlist.
     */
    public function toggle($product_id)
    {
        $exists = Wishlist::where('user_id', auth()->id())->where('product_id', $product_id)->first();
        
        if ($exists) {
            $exists->delete();
            return redirect()->back()->with('success', '✨ Produk dihapus dari wishlist!');
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $product_id,
            ]);
            return redirect()->back()->with('success', '✨ Produk ditambahkan ke wishlist!');
        }
    }
}
