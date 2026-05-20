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
        $product = \App\Models\Product::findOrFail($id);
        $relatedProducts = \App\Models\Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->take(4)
            ->get();
            
        if ($relatedProducts->count() < 4) {
            $relatedProducts = \App\Models\Product::where('id', '!=', $id)
                ->inRandomOrder()
                ->take(4)
                ->get();
        }

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
