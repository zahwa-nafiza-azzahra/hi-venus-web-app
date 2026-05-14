<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Katalog produk Hi Venus.
     */
    public function index(Request $request)
    {
        $products = \App\Models\Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Detail produk Hi Venus.
     */
    public function show($id)
    {
        return view('products.show', ['id' => $id]);
    }
}
