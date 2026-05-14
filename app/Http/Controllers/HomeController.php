<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index(Request $request) {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        $products = \App\Models\Product::latest()->take(4)->get();
        return view('home', compact('products'));
    }
}
