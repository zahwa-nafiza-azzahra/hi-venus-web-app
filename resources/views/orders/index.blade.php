@extends('layouts.app')

@section('title', 'Riwayat Pembelian | Hi Venus')

@section('body_class', 'cloud-pattern')

@push('styles')
<style>
    .cloud-pattern {
        background-color: #f0fdf4; /* Light Mint */
        background-image: url("data:image/svg+xml,%3Csvg width='80' height='40' viewBox='0 0 80 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10 40a10 10 0 0 1 10-10h40a10 10 0 0 1 10 10H10zM0 20a10 10 0 0 1 10-10h20a10 10 0 0 1 10 10H0zm60 0a10 10 0 0 1 10-10h10a10 10 0 0 1 10 10H60z' fill='%23ffffff' fill-opacity='0.4' fill-rule='evenodd'/%3E%3C/svg%3E");
    }
    .sticker-rotate-left { transform: rotate(-2deg); }
    .sticker-rotate-right { transform: rotate(3deg); }
    
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto p-margin-mobile md:p-margin-desktop py-12 relative z-10">
    <!-- Header Section -->
    <header class="mb-12 relative">
        <div class="absolute -top-10 -left-6 opacity-20 pointer-events-none">
            <span class="material-symbols-outlined text-[120px] text-primary">auto_awesome</span>
        </div>
        <h1 class="font-headline-xl text-headline-xl text-primary drop-shadow-[4px_4px_0px_rgba(27,28,28,1)] mb-4">Riwayat Pembelian</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl">Lihat semua keajaiban yang pernah kamu beli di sini! ✨</p>
    </header>

    @include('components.flash-messages')

    <!-- Filter Tabs -->
    <div class="flex overflow-x-auto pb-6 gap-4 no-scrollbar mb-10 animate-fade-in">
        <button class="whitespace-nowrap px-6 py-3 bg-secondary-container text-on-secondary-container border-4 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold active:translate-y-1 active:shadow-none transition-all">Semua</button>
        <button class="whitespace-nowrap px-6 py-3 bg-surface-container-lowest text-on-surface border-4 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold hover:bg-surface-variant active:translate-y-1 active:shadow-none transition-all">Menunggu Pembayaran</button>
        <button class="whitespace-nowrap px-6 py-3 bg-surface-container-lowest text-on-surface border-4 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold hover:bg-surface-variant active:translate-y-1 active:shadow-none transition-all">Diproses</button>
        <button class="whitespace-nowrap px-6 py-3 bg-surface-container-lowest text-on-surface border-4 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold hover:bg-surface-variant active:translate-y-1 active:shadow-none transition-all">Dikirim</button>
        <button class="whitespace-nowrap px-6 py-3 bg-surface-container-lowest text-on-surface border-4 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold hover:bg-surface-variant active:translate-y-1 active:shadow-none transition-all">Selesai</button>
        <button class="whitespace-nowrap px-6 py-3 bg-surface-container-lowest text-on-surface border-4 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold hover:bg-surface-variant active:translate-y-1 active:shadow-none transition-all">Dibatalkan</button>
    </div>

    @if($orders->count() > 0)
    <!-- Orders Grid (Standard Stable Grid) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter w-full">
        @foreach($orders as $index => $order)
            @php
                $statusLabel = match($order->status) {
                    'pending' => 'Menunggu Pembayaran',
                    'paid' => 'Diproses',
                    'shipped' => 'Dikirim',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                    default => 'Diproses'
                };

                $statusColor = match($order->status) {
                    'pending' => 'bg-error-container text-on-error-container',
                    'paid', 'processing' => 'bg-secondary-container text-on-secondary-container',
                    'completed' => 'bg-primary text-on-primary',
                    'shipped' => 'bg-tertiary-container text-on-tertiary-container',
                    'cancelled' => 'bg-outline text-white',
                    default => 'bg-surface-variant text-on-surface-variant'
                };

                $firstItem = $order->items->first();
                $productName = $firstItem ? $firstItem->product->name : 'Kawaii Haul ✨';
                $productImage = $firstItem && $firstItem->product->image ? $firstItem->product->image_url : 'https://lh3.googleusercontent.com/aida-public/AB6AXuDVOqrQTfzkDKhoCSvuaeRsV5PJlLSMa3Ddc2ZERotrAqyEoKaWwzZ3pQW4UcTg1tJULk1P8Z73vdghCX5q12676rosbBdbbEv5HCwoiiotF-1EYCvYn2HSOvpHMcKTONXmX0JrOSjQ5znsRObN6fnIqK8su7Oly0zhRhR-yEm6GECvTzUtNwZJ2AtRAKqX_NITt_CxW2yM1w6o7NzTEfdi4NVNOIX8FTNS-ikZ4lqAtNst7WeObBpFJ85NeJ4dbbPYEIPV-99_1D44';
            @endphp

            <!-- Order Card -->
            <div class="bg-surface-container-lowest border-4 border-on-background p-5 md:p-6 rounded-2xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] flex flex-col md:flex-row items-center md:items-start gap-6 relative">
                <!-- Status Badge -->
                <div class="absolute -top-3 right-4 z-20">
                    <div class="{{ $statusColor }} px-4 py-1 border-4 border-on-background font-label-bold rounded-full shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] text-[10px] uppercase tracking-tighter">
                        {{ $statusLabel }}
                    </div>
                </div>

                <!-- Product Image (Fixed Square) -->
                <div class="w-32 h-32 flex-shrink-0 bg-tertiary-fixed border-4 border-on-background rounded-xl flex items-center justify-center overflow-hidden bg-[radial-gradient(#c1e8ff_2px,transparent_2px)] [background-size:16px_16px]">
                    <img alt="{{ $productName }}" class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-300" src="{{ $productImage }}"/>
                </div>

                <!-- Order Info -->
                <div class="flex-1 min-w-0 flex flex-col w-full">
                    <div class="mb-4">
                        <p class="font-label-bold text-label-bold text-primary text-xs mb-0.5">#{{ $order->order_number }}</p>
                        <h3 class="font-headline-lg text-xl text-on-background truncate">{{ $productName }}</h3>
                        <p class="font-body-md text-xs text-on-surface-variant font-bold">{{ $order->created_at->format('d M Y') }} • {{ $order->items->count() }} Barang</p>
                    </div>

                    <div class="mt-auto flex flex-row justify-between items-center gap-2">
                        <div class="text-left">
                            <p class="text-[10px] font-black text-on-surface-variant uppercase tracking-tighter leading-none">Total</p>
                            <p class="font-price-display text-xl text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </div>
                        
                        <div class="flex gap-2">
                            @if($order->status === 'completed')
                                <a href="{{ route('reviews.create', $firstItem->product_id ?? 1) }}" class="px-3 py-1.5 bg-primary text-on-primary border-3 border-on-background rounded-lg font-label-bold shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-center text-xs">Ulas</a>
                            @endif
                                <a href="{{ route('orders.show', $order->id) }}" class="px-3 py-1.5 bg-surface-bright text-on-surface border-3 border-on-background rounded-lg font-label-bold shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-xs">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination / Load More -->
    <div class="mt-16 flex justify-center">
        <button class="flex items-center gap-4 px-10 py-6 bg-surface-container-lowest border-4 border-on-background rounded-xl font-headline-lg text-headline-lg shadow-[10px_10px_0px_0px_rgba(27,28,28,1)] hover:rotate-2 hover:-translate-y-2 transition-all group">
            Lihat Pesanan Lama 
            <span class="material-symbols-outlined text-4xl group-hover:rotate-180 transition-transform">expand_more</span>
        </button>
    </div>
    @else
    <!-- Empty State -->
    <div class="w-full py-20 text-center bg-white border-4 border-dashed border-on-background rounded-2xl animate-fade-in relative overflow-hidden">
        <div class="max-w-xl mx-auto relative z-10 px-4">
            <div class="relative inline-block mb-8">
                <div class="w-40 h-40 bg-white border-4 border-on-background rounded-full flex items-center justify-center shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] mx-auto overflow-hidden rotate-3 hover:rotate-0 transition-transform">
                    <img class="w-full h-full object-cover" src="https://api.dicebear.com/7.x/avataaars/svg?seed=sad-venus" alt="Sad character">
                </div>
                <span class="absolute -top-4 -right-6 material-symbols-outlined text-error text-5xl animate-pulse" style="font-variation-settings: 'FILL' 1;">heart_broken</span>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface mb-4 italic text-3xl">Belum ada riwayat pesanan. 🥺</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-10">Ayo buat pesanan pertamamu sekarang biar koleksi kamu makin lengkap! ✨</p>
            <a href="{{ route('products.index') }}" class="inline-block px-12 py-5 bg-primary text-on-primary border-4 border-on-background rounded-2xl font-headline-lg shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:shadow-none transition-all">
                BELANJA SEKARANG! 🛍️
            </a>
        </div>
    </div>
    @endif
</div>

<!-- Decorative Floating Sticker -->
<div class="fixed bottom-10 right-10 z-40 hidden md:block animate-bounce">
    <div class="bg-secondary-container p-6 rounded-full border-4 border-on-background shadow-[6px_6px_0px_0px_rgba(27,28,28,1)]">
        <span class="material-symbols-outlined text-5xl" style="font-variation-settings: 'FILL' 1;">sentiment_very_satisfied</span>
    </div>
</div>
@endsection
