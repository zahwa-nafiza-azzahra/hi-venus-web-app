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
     * New Arrivals Hi Venus.
     */
    public function newArrivals()
    {
        $products = \App\Models\Product::with('category')
            ->where('is_new', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Jika tidak ada yang ditandai is_new, ambil 12 terbaru
        if ($products->isEmpty()) {
            $products = \App\Models\Product::with('category')
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        }

        return view('products.new_arrivals', compact('products'));
    }

    /**
     * Best Sellers Hi Venus.
     */
    public function bestSellers()
    {
        $products = \App\Models\Product::with('category')
            ->withSum('orderItems', 'quantity')
            ->orderByRaw('COALESCE(order_items_sum_quantity, 0) DESC')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('products.best_sellers', compact('products'));
    }

    /**
     * Detail produk Hi Venus.
     */
    public function show($id)
    {
        $product = \App\Models\Product::with(['reviews' => function($q) {
            $q->where('status', 'approved')->latest();
        }, 'reviews.user', 'variants'])->findOrFail($id);
        
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
