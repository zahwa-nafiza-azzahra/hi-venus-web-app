<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\CashierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// ============================================
// Hi Venus Boutique Routes
// ============================================

// Products (public)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Cart & Checkout (authenticated users only)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout/shipping', [CheckoutController::class, 'shipping'])->name('checkout.shipping');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place_order');
});

// POS Kasir (Standalone route, accessible by admin and cashier)
Route::get('/pos', [PosController::class, 'index'])
    ->middleware(['auth', 'pos'])
    ->name('pos.index');

// Cashier Role Routes
Route::middleware(['auth', 'cashier'])->prefix('cashier')->name('cashier.')->group(function () {
    Route::get('/', [CashierController::class, 'index'])->name('index');
    Route::get('/catalog', [CashierController::class, 'catalog'])->name('catalog');
    Route::get('/pickup', [CashierController::class, 'pickup'])->name('pickup');
    Route::get('/receipt', [CashierController::class, 'receipt'])->name('receipt');
    Route::get('/report', [CashierController::class, 'report'])->name('report');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'show'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
    
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store']);

    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', function (\Illuminate\Http\Request $request) {
        $request->validate(['email' => 'required|email']);
        $status = \Illuminate\Support\Facades\Password::sendResetLink($request->only('email'));
        return $status === \Illuminate\Support\Facades\Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    })->name('password.email');

    Route::get('/reset-password/{token}', function (string $token, \Illuminate\Http\Request $request) {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    })->name('password.reset');

    Route::post('/reset-password', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $status = \Illuminate\Support\Facades\Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => \Illuminate\Support\Facades\Hash::make($password)])->setRememberToken(\Illuminate\Support\Str::random(60));
                $user->save();
            }
        );
        return $status === \Illuminate\Support\Facades\Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    })->name('password.update');
});

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/logout', function () {
    return redirect('/');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Settings
    Route::get('/settings', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.settings');
        }
        return view('settings');
    })->name('settings');
    Route::post('/settings/profile', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
        ]);
        auth()->user()->update($request->only('name', 'email', 'phone'));
        return back()->with('success', 'Profile updated successfully.');
    })->name('settings.profile');
    Route::post('/settings/password', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);
        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        auth()->user()->update(['password' => $request->password]);
        return back()->with('success', 'Password changed successfully.');
    })->name('settings.password');
    Route::post('/settings/avatar', function (\Illuminate\Http\Request $request) {
        $request->validate(['avatar' => 'required|image|mimes:png,jpg,jpeg|max:5120']);
        if (env('CLOUDINARY_URL')) {
            $path = \App\Services\CloudinaryService::upload($request->file('avatar'), 'avatars');
        } else {
            $path = $request->file('avatar')->store('avatars', 'public');
        }
        
        // Delete old avatar if exists (only if it's a local file, not an http url)
        if (auth()->user()->avatar && !str_starts_with(auth()->user()->avatar, 'http')) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete(auth()->user()->avatar);
        }
        
        if ($path) auth()->user()->update(['avatar' => $path]);
        return back()->with('success', 'Profile photo updated successfully.');
    })->name('settings.avatar');

    // Reviews
    Route::get('/reviews/create/{product_id}', function ($product_id) {
        $product = \App\Models\Product::findOrFail($product_id);
        return view('reviews.create', compact('product'));
    })->name('reviews.create');

    // Orders
    Route::get('/orders', function () {
        $orders = auth()->user()->orders()->latest()->get();
        return view('orders.index', compact('orders'));
    })->name('orders.index');

    Route::get('/orders/{id}', function ($id) {
        $order = auth()->user()->orders()->with('items.product')->findOrFail($id);
        return view('orders.show', compact('order'));
    })->name('orders.show');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/toggle/{product_id}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard Hi Venus — accessible at /admin AND /admin/dashboard
    Route::get('/', [DashboardController::class, 'adminIndex'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'adminIndex'])->name('dashboard.alias');
    
    // Admin Users (Customers & Staff)
    Route::get('users', function () {
        $users = \App\Models\User::whereNot('role', \App\Models\User::ROLE_ADMIN)
            ->withCount('orders')
            ->get()
            ->map(function($user) {
                $user->total_spent = \App\Models\Order::where('user_id', $user->id)
                    ->whereIn('status', ['paid', 'completed'])
                    ->sum('total_amount');
                $user->last_order_date = \App\Models\Order::where('user_id', $user->id)
                    ->latest()
                    ->first()?->created_at?->format('M d, Y') ?? 'No orders';
                return $user;
            });
        return view('admin.users.index', compact('users'));
    })->name('users.index');


    // Products Management
    Route::get('products', function () {
        $products = \App\Models\Product::with('variants')->paginate(12);
        $products->each(function($product) {
            $product->total_stock = $product->variants->sum('stock');
        });
        return view('admin.products.index', compact('products'));
    })->name('products.index');

    Route::get('products/{id}/edit', function ($id) {
        $product = \App\Models\Product::with('variants', 'category')->findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    })->name('products.edit');

    Route::post('products/{id}/update', function (\Illuminate\Http\Request $request, $id) {
        $product = \App\Models\Product::findOrFail($id);
        
        $data = $request->only('name', 'price', 'description', 'category_id');
        $data['is_featured'] = $request->has('is_featured');
        $data['is_visible'] = $request->has('is_visible');

        if ($request->hasFile('image')) {
            if (env('CLOUDINARY_URL')) {
                $path = \App\Services\CloudinaryService::upload($request->file('image'), 'products');
            } else {
                $path = $request->file('image')->store('products', 'public');
            }
            if ($path) {
                $data['image'] = $path;
            }
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', '✨ Product "' . $product->name . '" has been updated!');
    })->name('products.update');

    Route::get('settings', function () {
        return view('admin.settings');
    })->name('settings');
    Route::post('settings/profile', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
        ]);
        auth()->user()->update($request->only('name', 'email', 'phone'));
        return back()->with('success', 'Profile updated successfully.');
    })->name('settings.profile');
    Route::post('settings/password', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);
        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        auth()->user()->update(['password' => $request->password]);
        return back()->with('success', 'Password changed successfully.');
    })->name('settings.password');
    Route::post('settings/avatar', function (\Illuminate\Http\Request $request) {
        $request->validate(['avatar' => 'required|image|mimes:png,jpg,jpeg|max:5120']);
        if (env('CLOUDINARY_URL')) {
            $path = \App\Services\CloudinaryService::upload($request->file('avatar'), 'avatars');
        } else {
            $path = $request->file('avatar')->store('avatars', 'public');
        }

        // Delete old avatar if exists (only if it's a local file)
        if (auth()->user()->avatar && !str_starts_with(auth()->user()->avatar, 'http')) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete(auth()->user()->avatar);
        }

        if ($path) auth()->user()->update(['avatar' => $path]);
        return back()->with('success', 'Profile photo updated successfully.');
    })->name('settings.avatar');
});
