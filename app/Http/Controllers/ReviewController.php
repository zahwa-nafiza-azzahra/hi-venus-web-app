<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $product = Product::findOrFail($product_id);
        
        $imagePath = null;
        if ($request->hasFile('photo')) {
            if (env('CLOUDINARY_URL')) {
                $imagePath = \App\Services\CloudinaryService::upload($request->file('photo'), 'reviews');
            } else {
                $imagePath = $request->file('photo')->store('reviews', 'public');
            }
        }

        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'image' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()->route('products.show', $product->slug ?? $product->id)->with('success', 'Review submitted successfully! It will be visible after moderation.');
    }
}
