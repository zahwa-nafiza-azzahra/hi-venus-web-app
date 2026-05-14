@extends('layouts.admin')

@section('title', 'Admin Dashboard | Hi Venus')

@push('styles')
<style>
    /* Override global background only for dashboard */
    main > div.absolute.inset-0 { 
        display: none !important; 
    }
    main {
        background-color: #d0f0ff !important; /* Soft sky blue */
        background-image: 
            radial-gradient(#ff97cf 18%, transparent 18%),
            radial-gradient(#ffde59 18%, transparent 18%) !important;
        background-size: 80px 80px !important;
        background-position: 0 0, 40px 40px !important;
        background-attachment: fixed;
    }
    
    /* Ensure content visibility */
    .bubble-title {
        background-color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<header class="flex justify-between items-end mb-10">
    <div>
        <h2 class="bubble-title md:text-headline-xl">
            Dashboard Overview
            <!-- Decorative Sparkle -->
            <svg class="absolute -top-4 -right-12 w-10 h-10 text-secondary-container drop-shadow-[4px_4px_0px_#1b1c1c] animate-bounce" fill="currentColor" viewbox="0 0 24 24"><path d="M12 0L14.59 9.41L24 12L14.59 14.59L12 24L9.41 14.59L0 12L9.41 9.41L12 0Z"></path></svg>
        </h2>
        <p class="text-body-lg font-black text-on-surface-variant mt-2 italic">Welcome back! Here's what's happening today.</p>
    </div>
    <div class="ct-card bg-surface-bright px-8 py-3 flex items-center gap-2 rotate-2 shadow-[4px_4px_0px_0px_#1b1c1c]">
        <span class="material-symbols-outlined text-primary text-3xl">calendar_today</span>
        <span class="font-black italic text-xl">{{ now()->format('M d, Y') }}</span>
    </div>
</header>

<!-- Stats Grid -->
<section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-gutter mb-section-gap">
    <!-- Stat Card 1 -->
    <a href="{{ route('admin.dashboard') }}" class="ct-card ct-card-interactive bg-secondary-container p-6 relative overflow-hidden group">
        <div class="flex justify-between items-start mb-4">
            <p class="ct-sticker ct-sticker-primary text-[10px] scale-75 origin-top-left">Total Orders</p>
            <div class="w-14 h-14 bg-surface-bright border-4 border-on-background rounded-full flex items-center justify-center shadow-[4px_4px_0px_0px_#1b1c1c]">
                <span class="material-symbols-outlined text-on-background text-3xl">local_shipping</span>
            </div>
        </div>
        <h3 class="text-price-display text-4xl text-on-secondary-container mb-2 italic">{{ number_format($stats['totalOrders']) }}</h3>
        <span class="ct-badge bg-surface-bright">{{ $stats['pendingOrders'] }} Pending</span>
    </a>
    <!-- Stat Card 2 -->
    <div class="ct-card ct-card-interactive bg-tertiary-container p-6 relative overflow-hidden group">
        <div class="flex justify-between items-start mb-4">
            <p class="ct-sticker ct-sticker-secondary text-[10px] scale-75 origin-top-left">Today Revenue</p>
            <div class="w-14 h-14 bg-surface-bright border-4 border-on-background rounded-full flex items-center justify-center shadow-[4px_4px_0px_0px_#1b1c1c]">
                <span class="material-symbols-outlined text-on-background text-3xl">payments</span>
            </div>
        </div>
        <h3 class="text-price-display text-2xl text-on-tertiary-container mb-2 italic">Rp {{ number_format($stats['todayRevenue'], 0, ',', '.') }}</h3>
        <span class="ct-badge bg-surface-bright">Today's Sales</span>
    </div>
    <!-- Stat Card 3 -->
    <a href="{{ route('admin.users.index') }}" class="ct-card ct-card-interactive bg-primary-container p-6 relative overflow-hidden group">
        <div class="flex justify-between items-start mb-4">
            <p class="ct-sticker ct-sticker-tertiary text-[10px] scale-75 origin-top-left">Customers & Staff</p>
            <div class="w-14 h-14 bg-surface-bright border-4 border-on-background rounded-full flex items-center justify-center shadow-[4px_4px_0px_0px_#1b1c1c]">
                <span class="material-symbols-outlined text-on-background text-3xl">face_4</span>
            </div>
        </div>
        <h3 class="text-price-display text-4xl text-on-primary-container mb-2 italic">{{ number_format($stats['totalUsers']) }}</h3>
        <span class="ct-badge bg-surface-bright">Active Members</span>
    </a>
    <!-- Stat Card 4 -->
    <a href="{{ route('admin.products.index') }}" class="ct-card ct-card-interactive bg-tertiary-fixed p-6 relative overflow-hidden group">
        <div class="flex justify-between items-start mb-4">
            <p class="ct-sticker ct-sticker-primary text-[10px] scale-75 origin-top-left rotate-[-5deg]">Inventory</p>
            <div class="w-14 h-14 bg-surface-bright border-4 border-on-background rounded-full flex items-center justify-center shadow-[4px_4px_0px_0px_#1b1c1c]">
                <span class="material-symbols-outlined text-on-background text-3xl">inventory_2</span>
            </div>
        </div>
        <h3 class="text-price-display text-4xl text-on-tertiary-fixed-variant mb-2 italic">{{ \App\Models\Product::count() }}</h3>
        <span class="ct-badge bg-surface-bright">Items Listed</span>
    </a>
</section>

<!-- Middle Section -->
<section class="grid grid-cols-1 lg:grid-cols-3 gap-gutter mb-section-gap">
    <!-- Chart Card -->
    <div class="lg:col-span-2 ct-card p-6 flex flex-col dots-bg">
        <div class="flex justify-between items-center mb-8">
            <h3 class="bubble-title text-3xl">Sales Overview</h3>
            <div class="flex gap-4">
                <button class="ct-btn ct-btn-secondary px-4 py-2 scale-75 origin-right">Weekly</button>
                <button class="ct-btn ct-btn-outline px-4 py-2 scale-75 origin-right">Monthly</button>
            </div>
        </div>
        <!-- Mockup Chart -->
        <div class="flex-1 min-h-[300px] bg-surface-bright border-4 border-on-background rounded-2xl p-6 relative shadow-[inset_0px_4px_0px_0px_rgba(27,28,28,0.1)] overflow-hidden">
            <svg class="w-full h-full" viewbox="0 0 100 100" preserveaspectratio="none">
                <path d="M 0 80 Q 20 75, 40 40 T 80 20 T 100 30" fill="none" stroke="var(--color-primary)" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" class="animate-draw-path"></path>
                <circle cx="0" cy="80" r="4" fill="white" stroke="black" stroke-width="2"></circle>
                <circle cx="40" cy="40" r="4" fill="white" stroke="black" stroke-width="2"></circle>
                <circle cx="80" cy="20" r="4" fill="var(--color-secondary-container)" stroke="black" stroke-width="2"></circle>
            </svg>
        </div>
    </div>
    <!-- Top Products -->
    <div class="ct-card bg-primary-fixed p-6 relative">
        <div class="ct-sticker ct-sticker-secondary absolute -top-4 -right-4 rotate-12 scale-110">
            <span class="material-symbols-outlined text-4xl">star</span>
        </div>
        <h3 class="bubble-title text-3xl mb-8">Top Items</h3>
        <div class="space-y-4">
            @foreach(\App\Models\Product::take(3)->get() as $product)
            <div class="bg-surface-bright border-4 border-on-background rounded-xl p-4 flex items-center gap-4 shadow-[4px_4px_0px_0px_#1b1c1c] hover:scale-105 transition-transform">
                <div class="w-12 h-12 bg-primary-container border-2 border-on-background rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-background">auto_awesome</span>
                </div>
                <div class="flex-1">
                    <h4 class="font-black italic leading-tight line-clamp-1">{{ $product->name }}</h4>
                    <p class="text-xs font-bold text-on-surface-variant uppercase tracking-tighter">{{ $product->category->name ?? 'Premium Item' }}</p>
                </div>
                <div class="text-xl font-black text-primary">Rp{{ number_format($product->price/1000, 0) }}k</div>
            </div>
            @endforeach
        </div>
        <a href="{{ route('admin.products.index') }}" class="ct-btn ct-btn-outline w-full mt-8">View Inventory</a>
    </div>
</section>

<!-- Table Section -->
<section class="ct-card">
    <div class="p-6 border-b-4 border-on-background bg-surface-variant flex justify-between items-center">
        <h3 class="bubble-title text-3xl">Recent Orders</h3>
        <a href="{{ route('admin.dashboard') }}" class="ct-btn ct-btn-primary scale-90 origin-right">
            See All
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-high border-b-4 border-on-background">
                    <th class="p-4 border-r-4 border-on-background font-black uppercase tracking-widest text-xs">Order ID</th>
                    <th class="p-4 border-r-4 border-on-background font-black uppercase tracking-widest text-xs">Customer</th>
                    <th class="p-4 border-r-4 border-on-background font-black uppercase tracking-widest text-xs">Status</th>
                    <th class="p-4 font-black uppercase tracking-widest text-xs text-right">Total</th>
                </tr>
            </thead>
            <tbody class="font-bold italic">
                @forelse($recentOrders as $order)
                <tr class="border-b-4 border-on-background hover:bg-surface-container-highest transition-colors">
                    <td class="p-4 border-r-4 border-on-background text-primary">#{{ $order->order_number }}</td>
                    <td class="p-4 border-r-4 border-on-background">{{ $order->user->name ?? 'Guest' }}</td>
                    <td class="p-4 border-r-4 border-on-background">
                        <span class="ct-badge bg-tertiary-container -rotate-2">{{ strtoupper($order->status) }}</span>
                    </td>
                    <td class="p-4 text-right text-xl font-black text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-12 text-center bg-surface-bright">
                        <div class="flex flex-col items-center gap-4 opacity-50">
                            <span class="material-symbols-outlined text-6xl">shopping_cart_off</span>
                            <p class="font-black italic text-xl">No orders yet! Waiting for your first customer...</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
