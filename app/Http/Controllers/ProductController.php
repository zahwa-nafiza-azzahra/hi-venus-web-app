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
        $query = \App\Models\Product::with('category');

        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->paginate(8)->withQueryString();
        $categories = \App\Models\Category::all();
        
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Detail produk Hi Venus.
     */
    public function show($id)
    {
        return view('products.show', ['id' => $id]);
    }
}
