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

        <!-- Catalog Quick Link -->
        <a href="{{ route('cashier.catalog') }}" class="bg-white border-4 border-on-background p-6 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all group">
            <div class="w-16 h-16 bg-tertiary-container border-4 border-on-background rounded-2xl flex items-center justify-center mb-6 group-hover:-rotate-6 transition-transform">
                <span class="material-symbols-outlined text-4xl text-white" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
            </div>
            <h3 class="font-headline-lg text-2xl mb-2">Cek Stok</h3>
            <p class="text-on-surface-variant text-sm">Lihat ketersediaan barang dan SKU produk.</p>
        </a>

        <!-- Pickup Quick Link -->
        <a href="{{ route('cashier.pickup') }}" class="bg-white border-4 border-on-background p-6 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all group">
            <div class="w-16 h-16 bg-primary-fixed border-4 border-on-background rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-4xl text-primary" style="font-variation-settings: 'FILL' 1;">local_shipping</span>
            </div>
            <h3 class="font-headline-lg text-2xl mb-2">Pickup Online</h3>
            <p class="text-on-surface-variant text-sm">Verifikasi kode pickup untuk pesanan online.</p>
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

    <!-- Daily Summary Bento -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter mt-12">
        <div class="lg:col-span-2 bg-white border-4 border-on-background p-8 rounded-xl shadow-[12px_12px_0px_0px_rgba(27,28,28,1)]">
            <h3 class="font-headline-lg mb-8 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">trending_up</span>
                Aktivitas Hari Ini
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-surface-container-low p-6 rounded-xl border-2 border-on-background">
                    <p class="text-xs font-black uppercase text-on-surface-variant mb-1">Transaksi</p>
                    <p class="text-4xl font-headline-xl">24</p>
                </div>
                <div class="bg-surface-container-low p-6 rounded-xl border-2 border-on-background">
                    <p class="text-xs font-black uppercase text-on-surface-variant mb-1">Items Terjual</p>
                    <p class="text-4xl font-headline-xl">86</p>
                </div>
                <div class="bg-surface-container-low p-6 rounded-xl border-2 border-on-background">
                    <p class="text-xs font-black uppercase text-on-surface-variant mb-1">Points Earned</p>
                    <p class="text-4xl font-headline-xl text-primary">1.2k</p>
                </div>
            </div>
        </div>

        <!-- System Message / Info -->
        <div class="bg-secondary-fixed border-4 border-on-background p-8 rounded-xl shadow-[12px_12px_0px_0px_rgba(27,28,28,1)] relative overflow-hidden">
            <div class="absolute -bottom-4 -right-4 opacity-10">
                <span class="material-symbols-outlined text-[100px]">info</span>
            </div>
            <h3 class="font-label-bold text-xl mb-4 italic">Catatan Kasir 📝</h3>
            <ul class="space-y-4 font-body-md">
                <li class="flex gap-3">
                    <span class="material-symbols-outlined text-sm">check_circle</span>
                    Pastikan printer struk menyala.
                </li>
                <li class="flex gap-3">
                    <span class="material-symbols-outlined text-sm">check_circle</span>
                    Cek stok untuk SKU Bunny Plushie (Menipis!).
                </li>
                <li class="flex gap-3">
                    <span class="material-symbols-outlined text-sm">check_circle</span>
                    Promo member Venus Points aktif.
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
