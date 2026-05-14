<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = auth()->user();
        
        if ($currentUser->role === User::ROLE_ADMIN) {
            return $this->showManagerPanel();
        }

        if ($currentUser->role === User::ROLE_CASHIER) {
            return redirect()->route('cashier.index');
        }

        return $this->showMemberHub($request);
    }

    public function adminIndex()
    {
        return $this->showManagerPanel();
    }

    protected function showManagerPanel()
    {
        $stats = [
            'totalOrders'   => Order::count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'todayRevenue'  => Order::whereDate('created_at', today())->whereIn('status', ['paid', 'completed'])->sum('total_amount'),
            'totalUsers'    => User::where('role', User::ROLE_USER)->count(),
        ];

        $recentOrders = Order::with('user')->latest()->limit(5)->get();

        return view('admin.dashboard', [
            'stats'         => $stats,
            'recentOrders'  => $recentOrders,
        ]);
    }

    protected function showMemberHub(Request $request)
    {
        $myActiveOrders = Order::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'paid'])
            ->latest()
            ->limit(5)
            ->get();

        $productList = Product::with('category');
        
        if ($request->has('search')) {
            $productList->where('name', 'like', '%' . $request->search . '%');
        }
        
        return view('dashboard', [
            'activeOrders'  => $myActiveOrders,
            'products'      => $productList->paginate(9)->withQueryString(),
            'categories'    => Category::all(),
        ]);
    }
}
