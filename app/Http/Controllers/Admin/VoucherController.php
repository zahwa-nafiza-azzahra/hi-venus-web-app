<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::latest()->paginate(10);
        $totalActive = Voucher::where('is_active', true)->count();
        $totalUsed = Voucher::sum('quota_used');
        $totalDiscounted = \App\Models\Order::whereNotNull('discount_amount')->sum('discount_amount');
        $expiringSoon = Voucher::where('is_active', true)
                            ->whereNotNull('end_date')
                            ->where('end_date', '<=', now()->addDays(7))
                            ->count();

        return view('admin.vouchers.index', compact('vouchers', 'totalActive', 'totalUsed', 'totalDiscounted', 'expiringSoon'));
    }
}
