<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class CashierController extends Controller
{
    /**
     * Halaman Utama Kasir (Dashboard).
     */
    public function index()
    {
        return view('cashier.dashboard');
    }

    /**
     * Halaman Lihat Katalog & Stok - read-only.
     */
    public function catalog()
    {
        $products = Product::with('variants')->get();
        return view('cashier.catalog', compact('products'));
    }

    /**
     * Verifikasi Pickup Online.
     */
    public function pickup()
    {
        return view('cashier.pickup');
    }

    /**
     * Cetak Struk.
     */
    public function receipt()
    {
        return view('cashier.receipt');
    }

    /**
     * Laporan Harian per Kasir.
     */
    public function report()
    {
        return view('cashier.report');
    }
}
