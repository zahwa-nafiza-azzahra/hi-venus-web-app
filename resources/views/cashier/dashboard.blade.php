@extends('layouts.cashier')

@section('title', 'Dashboard Kasir | Hi Venus')
@section('page_title', 'Halaman Utama Kasir')

@section('content')
<div class="space-y-gutter animate-fade-in">
    <!-- Welcome Section -->
    <div class="bg-primary-container p-8 rounded-lg border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] relative overflow-hidden">
        <div class="absolute -top-4 -right-4 opacity-20 rotate-12">
            <span class="material-symbols-outlined text-[150px]" style="font-variation-settings: 'FILL' 1;">sparkles</span>
        </div>
        <div class="relative z-10">
            <p class="font-label-bold text-on-primary-container uppercase tracking-widest mb-2">SELAMAT BEKERJA! ✨</p>
            <h1 class="font-headline-xl text-on-primary-container">Halo, {{ auth()->user()->name }}!</h1>
            <p class="font-body-lg text-on-primary-container opacity-90 max-w-xl mt-4">
                Siap memberikan keceriaan hari ini? Pastikan semua stok aman dan pesanan diproses dengan cinta! 💖
            </p>
        </div>
    </div>

    <!-- Quick Actions Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
        <!-- POS Quick Link -->
        <a href="{{ route('pos.index') }}" class="bg-white border-4 border-on-background p-6 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all group">
            <div class="w-16 h-16 bg-secondary-container border-4 border-on-background rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">point_of_sale</span>
            </div>
            <h3 class="font-headline-lg text-2xl mb-2">Buka POS</h3>
            <p class="text-on-surface-variant text-sm">Mulai transaksi baru untuk pelanggan toko.</p>
        </a>

        <!-- Pesanan Online -->
        <a href="{{ route('cashier.orders') }}" class="bg-white border-4 border-on-background p-6 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all group relative">
            @if($pendingOrders > 0)
            <span class="absolute -top-3 -right-3 bg-error text-on-error text-xs font-black rounded-full w-8 h-8 flex items-center justify-center border-4 border-white animate-bounce">{{ $pendingOrders }}</span>
            @endif
            <div class="w-16 h-16 bg-error-container border-4 border-on-background rounded-2xl flex items-center justify-center mb-6 group-hover:-rotate-6 transition-transform">
                <span class="material-symbols-outlined text-4xl text-on-error-container" style="font-variation-settings: 'FILL' 1;">package_2</span>
            </div>
            <h3 class="font-headline-lg text-2xl mb-2">Pesanan Online</h3>
            <p class="text-on-surface-variant text-sm">Konfirmasi & proses pesanan dari pelanggan online.</p>
        </a>

        <!-- Catalog Quick Link -->
        <a href="{{ route('cashier.catalog') }}" class="bg-white border-4 border-on-background p-6 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all group">
            <div class="w-16 h-16 bg-tertiary-container border-4 border-on-background rounded-2xl flex items-center justify-center mb-6 group-hover:-rotate-6 transition-transform">
                <span class="material-symbols-outlined text-4xl text-white" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
            </div>
            <h3 class="font-headline-lg text-2xl mb-2">Cek Stok</h3>
            <p class="text-on-surface-variant text-sm">Lihat ketersediaan barang dan SKU produk.</p>
        </a>

        <!-- Report Quick Link -->
        <a href="{{ route('cashier.report') }}" class="bg-white border-4 border-on-background p-6 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all group">
            <div class="w-16 h-16 bg-surface-variant border-4 border-on-background rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-12 transition-transform">
                <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">analytics</span>
            </div>
            <h3 class="font-headline-lg text-2xl mb-2">Laporan Shift</h3>
            <p class="text-on-surface-variant text-sm">Lihat ringkasan transaksi shift hari ini.</p>
        </a>
    </div>

    <!-- Order Stats Row -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-error-container border-4 border-on-background p-5 rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] text-center">
            <p class="text-4xl font-black text-on-error-container">{{ $pendingOrders }}</p>
            <p class="text-xs font-bold text-on-error-container/70 uppercase mt-1">Menunggu Konfirmasi</p>
        </div>
        <div class="bg-tertiary-container border-4 border-on-background p-5 rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] text-center">
            <p class="text-4xl font-black text-on-tertiary-container">{{ $processingOrders }}</p>
            <p class="text-xs font-bold text-on-tertiary-container/70 uppercase mt-1">Sedang Dikemas</p>
        </div>
        <div class="bg-primary-container border-4 border-on-background p-5 rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] text-center">
            <p class="text-4xl font-black text-on-primary-container">{{ $shippedOrders }}</p>
            <p class="text-xs font-bold text-on-primary-container/70 uppercase mt-1">Dalam Pengiriman</p>
        </div>
        <div class="bg-primary border-4 border-on-background p-5 rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] text-center">
            <p class="text-4xl font-black text-on-primary">{{ $todayCompleted }}</p>
            <p class="text-xs font-bold text-on-primary/80 uppercase mt-1">Selesai Hari Ini</p>
        </div>
    </div>

    <!-- Recent Pending Orders -->
    <div class="bg-white border-4 border-on-background rounded-xl shadow-[12px_12px_0px_0px_rgba(27,28,28,1)] overflow-hidden">
        <div class="p-6 border-b-4 border-on-background flex items-center justify-between">
            <h3 class="font-headline-lg text-xl flex items-center gap-2">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">pending_actions</span>
                Pesanan Perlu Diproses
            </h3>
            <a href="{{ route('cashier.orders') }}"
                class="text-xs font-black text-primary border-2 border-primary px-4 py-2 rounded-lg hover:bg-primary hover:text-on-primary transition-colors">
                Lihat Semua →
            </a>
        </div>
        @if($recentOrders->count() > 0)
        <div class="divide-y-4 divide-surface-container">
            @foreach($recentOrders as $order)
            <div class="p-5 flex items-center gap-4 hover:bg-surface-container-lowest transition-colors">
                <div class="w-12 h-12 rounded-xl border-2 border-on-background overflow-hidden flex-shrink-0 bg-surface-container">
                    @if($order->items->first()?->product?->image)
                    <img src="{{ $order->items->first()->product->image_url }}" class="w-full h-full object-cover" alt="">
                    @else
                    <span class="material-symbols-outlined w-full h-full flex items-center justify-center text-xl text-on-surface-variant">image</span>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-label-bold text-sm text-primary">#{{ $order->order_number }}</p>
                    <p class="font-bold text-sm text-on-surface truncate">{{ $order->user?->name }}</p>
                    <p class="text-xs text-on-surface-variant">{{ $order->created_at->diffForHumans() }}</p>
                </div>
                <div class="flex items-center gap-3 flex-shrink-0">
                    <span class="px-3 py-1 border-2 border-on-background rounded-full text-xs font-black uppercase {{ $order->status_color }}">
                        {{ $order->status_label }}
                    </span>
                    <a href="{{ route('cashier.orders.show', $order->id) }}"
                        class="p-2 bg-primary text-on-primary border-2 border-on-background rounded-lg hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-sm">open_in_new</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="p-12 text-center">
            <span class="material-symbols-outlined text-5xl text-on-surface-variant/30 block mb-2" style="font-variation-settings:'FILL' 1">task_alt</span>
            <p class="font-bold text-on-surface-variant">Semua pesanan sudah diproses! 🎉</p>
        </div>
        @endif
    </div>
</div>
@endsection
