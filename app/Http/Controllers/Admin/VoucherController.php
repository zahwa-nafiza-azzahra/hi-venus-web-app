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
        $totalDiscounted = 0; // Discount tracking not yet implemented in orders table
        $expiringSoon = Voucher::where('is_active', true)
                            ->whereNotNull('end_date')
                            ->where('end_date', '<=', now()->addDays(7))
                            ->count();

        return view('admin.vouchers.index', compact('vouchers', 'totalActive', 'totalUsed', 'totalDiscounted', 'expiringSoon'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:vouchers,code|max:255',
            'type' => 'required|in:percentage,fixed,free_shipping',
            'value' => 'required_unless:type,free_shipping|nullable|numeric|min:0',
            'min_spend' => 'nullable|numeric|min:0',
            'quota' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        Voucher::create($request->all());

        return back()->with('success', 'Voucher berhasil dibuat! 🎟️');
    }

    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);

        $request->validate([
            'code' => 'required|string|max:255|unique:vouchers,code,' . $voucher->id,
            'type' => 'required|in:percentage,fixed,free_shipping',
            'value' => 'required_unless:type,free_shipping|nullable|numeric|min:0',
            'min_spend' => 'nullable|numeric|min:0',
            'quota' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $voucher->update($request->all());

        return back()->with('success', 'Voucher berhasil diperbarui! ✨');
    }

    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        return back()->with('success', 'Voucher berhasil dihapus! 🗑️');
    }

    public function toggleStatus($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->update(['is_active' => !$voucher->is_active]);

        $status = $voucher->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Voucher {$voucher->code} berhasil {$status}! ⚡");
    }
}
