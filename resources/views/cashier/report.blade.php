@extends('layouts.cashier')

@section('title', 'Laporan Shift | Hi Venus')
@section('page_title', 'Laporan Harian Shift')

@section('content')
<div class="space-y-gutter animate-fade-in">
    <!-- Report Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 bg-primary-container p-8 rounded-lg border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] relative overflow-hidden">
        <div class="absolute -top-4 -right-4 opacity-20">
            <span class="material-symbols-outlined text-[150px]" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
        </div>
        <div class="relative z-10">
            <p class="font-label-bold text-on-primary-container uppercase tracking-widest mb-2">SHIFT SUMMARY</p>
            <h3 class="font-headline-xl text-headline-xl text-on-primary-container">Ringkasan Penjualan Hari Ini</h3>
            <p class="font-body-lg text-on-primary-container opacity-90">{{ now()->translatedFormat('l, d F Y') }} • 08:00 - Sekarang</p>
        </div>
        <div class="bg-white border-4 border-on-background p-5 rounded-2xl rotate-3 shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] relative z-10">
            <p class="font-label-bold text-on-surface-variant text-xs uppercase tracking-widest">KODE SHIFT</p>
            <p class="font-headline-lg text-primary">#SHFT-{{ date('ymd') }}</p>
        </div>
    </div>

    <!-- Summary Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
        <!-- Total Transaksi -->
        <div class="bg-white border-4 border-on-background p-8 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:scale-[1.02] transition-transform group">
            <div class="flex items-center gap-4 mb-6">
                <div class="p-4 bg-tertiary-container border-4 border-on-background rounded-full group-hover:rotate-12 transition-transform">
                    <span class="material-symbols-outlined text-white text-3xl" style="font-variation-settings: 'FILL' 1;">receipt_long</span>
                </div>
                <h4 class="font-label-bold text-lg">Total Transaksi</h4>
            </div>
            <p class="font-headline-xl text-5xl">42</p>
            <p class="text-on-surface-variant font-bold text-sm mt-2 flex items-center gap-1">
                <span class="material-symbols-outlined text-green-600">trending_up</span>
                +12% dari shift sebelumnya
            </p>
        </div>

        <!-- Produk Terjual -->
        <div class="bg-white border-4 border-on-background p-8 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:scale-[1.02] transition-transform group">
            <div class="flex items-center gap-4 mb-6">
                <div class="p-4 bg-secondary-container border-4 border-on-background rounded-full group-hover:-rotate-12 transition-transform">
                    <span class="material-symbols-outlined text-on-secondary-fixed text-3xl" style="font-variation-settings: 'FILL' 1;">shopping_bag</span>
                </div>
                <h4 class="font-label-bold text-lg">Produk Terjual</h4>
            </div>
            <p class="font-headline-xl text-5xl">156 <span class="text-xl">Items</span></p>
            <p class="text-on-surface-variant font-bold text-sm mt-2">Populer: Bunny Sticker Pack 🎀</p>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-primary-fixed border-4 border-on-background p-8 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:scale-[1.02] transition-transform relative group overflow-hidden">
            <span class="absolute top-2 right-2 material-symbols-outlined text-primary opacity-20 text-6xl group-hover:scale-125 transition-transform">star</span>
            <div class="flex items-center gap-4 mb-6">
                <div class="p-4 bg-primary border-4 border-on-background rounded-full">
                    <span class="material-symbols-outlined text-on-primary text-3xl" style="font-variation-settings: 'FILL' 1;">payments</span>
                </div>
                <h4 class="font-label-bold text-lg text-on-primary-fixed">Total Pendapatan</h4>
            </div>
            <p class="font-headline-xl text-5xl text-on-primary-container italic">Rp 4.520k</p>
            <p class="text-primary font-black text-sm mt-2 uppercase tracking-widest">Target Tercapai! 🎉</p>
        </div>
    </div>

    <!-- Transaction Table Card -->
    <div class="bg-white border-4 border-on-background rounded-2xl shadow-[12px_12px_0px_0px_rgba(27,28,28,1)] overflow-hidden">
        <div class="p-8 border-b-4 border-on-background bg-surface-container flex justify-between items-center">
            <h3 class="font-headline-lg text-headline-lg italic">Riwayat Transaksi Terakhir</h3>
            <div class="flex gap-3">
                <button class="p-3 border-4 border-on-background bg-white rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-0.5 hover:shadow-none transition-all">
                    <span class="material-symbols-outlined">filter_list</span>
                </button>
                <button class="p-3 border-4 border-on-background bg-white rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-0.5 hover:shadow-none transition-all">
                    <span class="material-symbols-outlined">search</span>
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-variant">
                        <th class="p-6 border-b-4 border-r-4 border-on-background font-black uppercase tracking-widest text-xs">ID Transaksi</th>
                        <th class="p-6 border-b-4 border-r-4 border-on-background font-black uppercase tracking-widest text-xs">Waktu</th>
                        <th class="p-6 border-b-4 border-r-4 border-on-background font-black uppercase tracking-widest text-xs">Metode</th>
                        <th class="p-6 border-b-4 border-r-4 border-on-background font-black uppercase tracking-widest text-xs">Pelanggan</th>
                        <th class="p-6 border-b-4 border-r-4 border-on-background font-black uppercase tracking-widest text-xs">Pelanggan</th>
                        <th class="p-6 border-b-4 border-r-4 border-on-background font-black uppercase tracking-widest text-xs text-right">Total</th>
                        <th class="p-6 border-b-4 border-on-background font-black uppercase tracking-widest text-xs text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-4 divide-on-background">
                    <tr class="hover:bg-primary-fixed-dim transition-colors group">
                        <td class="p-6 border-r-4 border-on-background font-black italic">#TRX-8801</td>
                        <td class="p-6 border-r-4 border-on-background font-bold">15:42</td>
                        <td class="p-6 border-r-4 border-on-background">
                            <span class="bg-secondary-container px-4 py-1 border-2 border-on-background rounded-full text-[10px] font-black uppercase shadow-sm">QRIS VENUS</span>
                        </td>
                        <td class="p-6 border-r-4 border-on-background font-bold">Budi Santoso</td>
                        <td class="p-6 border-r-4 border-on-background text-right font-headline-lg text-primary text-xl">Rp 125k</td>
                        <td class="p-6 text-center">
                            <a href="{{ route('cashier.receipt') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border-2 border-on-background rounded-lg shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] hover:translate-y-0.5 hover:shadow-none transition-all">
                                <span class="material-symbols-outlined text-sm">print</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="hover:bg-primary-fixed-dim transition-colors group">
                        <td class="p-6 border-r-4 border-on-background font-black italic">#TRX-8802</td>
                        <td class="p-6 border-r-4 border-on-background font-bold">15:10</td>
                        <td class="p-6 border-r-4 border-on-background">
                            <span class="bg-tertiary-container px-4 py-1 border-2 border-on-background rounded-full text-[10px] font-black uppercase text-white shadow-sm">Tunai</span>
                        </td>
                        <td class="p-6 border-r-4 border-on-background font-bold italic opacity-50">Guest Pelanggan</td>
                        <td class="p-6 border-r-4 border-on-background text-right font-headline-lg text-primary text-xl">Rp 45k</td>
                        <td class="p-6 text-center">
                            <a href="{{ route('cashier.receipt') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border-2 border-on-background rounded-lg shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] hover:translate-y-0.5 hover:shadow-none transition-all">
                                <span class="material-symbols-outlined text-sm">print</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="hover:bg-primary-fixed-dim transition-colors group">
                        <td class="p-6 border-r-4 border-on-background font-black italic">#TRX-8803</td>
                        <td class="p-6 border-r-4 border-on-background font-bold">14:55</td>
                        <td class="p-6 border-r-4 border-on-background">
                            <span class="bg-secondary-container px-4 py-1 border-2 border-on-background rounded-full text-[10px] font-black uppercase shadow-sm">QRIS VENUS</span>
                        </td>
                        <td class="p-6 border-r-4 border-on-background font-bold">Siska Amelia</td>
                        <td class="p-6 border-r-4 border-on-background text-right font-headline-lg text-primary text-xl">Rp 890k</td>
                        <td class="p-6 text-center">
                            <a href="{{ route('cashier.receipt') }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border-2 border-on-background rounded-lg shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] hover:translate-y-0.5 hover:shadow-none transition-all">
                                <span class="material-symbols-outlined text-sm">print</span>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Final Action Button -->
    <div class="flex justify-center pt-12">
        <button class="flex items-center gap-4 bg-primary text-on-primary px-12 py-6 rounded-2xl border-4 border-on-background font-headline-lg shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] transition-all active:scale-95 group">
            <span class="material-symbols-outlined text-4xl group-hover:rotate-12 transition-transform">print</span>
            <span>Cetak Laporan Shift 📄</span>
        </button>
    </div>
</div>
@endsection
