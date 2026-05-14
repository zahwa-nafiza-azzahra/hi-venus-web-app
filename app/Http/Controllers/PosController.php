<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Halaman POS Kasir Hi Venus.
     * Hanya bisa diakses oleh admin.
     */
    public function index()
    {
        $layout = auth()->user()->isCashier() ? 'layouts.cashier' : 'layouts.admin';
        return view('pos.index', compact('layout'));
    }
}
