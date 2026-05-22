<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CashierController extends Controller
{
    public function index()
    {
        $cashiers = User::where('role', User::ROLE_CASHIER)->latest()->get();
        return view('admin.cashiers.index', compact('cashiers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->username . '@kasir.hivenus', // dummy email since it's required by db unless nullable
            'password' => Hash::make($request->password),
            'role' => User::ROLE_CASHIER,
            'is_active' => true,
        ]);

        return back()->with('success', 'Akun kasir berhasil dibuat!');
    }

    public function update(Request $request, $id)
    {
        $cashier = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
        ]);

        $cashier->update([
            'name' => $request->name,
            'username' => $request->username,
        ]);

        return back()->with('success', 'Data kasir berhasil diperbarui!');
    }

    public function toggleStatus($id)
    {
        $cashier = User::findOrFail($id);
        $cashier->update(['is_active' => !$cashier->is_active]);

        $status = $cashier->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Akun kasir berhasil {$status}.");
    }

    public function resetPassword(Request $request, $id)
    {
        $cashier = User::findOrFail($id);

        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        $cashier->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Kata sandi kasir berhasil direset!');
    }
}
