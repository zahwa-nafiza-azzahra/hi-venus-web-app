<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', User::ROLE_USER);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // We can use get() since it's an admin dashboard and we map the data
        $users = $query->withCount('orders')
            ->latest()
            ->get()
            ->map(function ($user) {
                $user->total_spent = Order::where('user_id', $user->id)
                    ->whereIn('status', ['paid', 'completed'])
                    ->sum('total_amount');
                $user->last_order_date = Order::where('user_id', $user->id)
                    ->latest()
                    ->first()?->created_at?->format('M d, Y') ?? 'No orders';
                return $user;
            });

        return view('admin.users.index', compact('users'));
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active' => !$user->is_active]);

        $statusMessage = $user->is_active ? 'diaktifkan kembali' : 'di-suspend';
        return back()->with('success', "Akun pembeli {$user->name} berhasil {$statusMessage}.");
    }
}
