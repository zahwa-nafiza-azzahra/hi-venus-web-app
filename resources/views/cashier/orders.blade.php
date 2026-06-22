@extends('layouts.cashier')
@section('title', 'Manajemen Pesanan | Hi Venus')
@section('page_title', 'Pesanan Online')

@section('content')
<div class="animate-fade-in space-y-6">

    @if(session('success'))
    <div class="bg-primary-container border-4 border-on-background p-4 rounded-xl flex items-center gap-3 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]">
        <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">check_circle</span>
        <p class="font-label-bold text-on-primary-container">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Stats Row --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('cashier.orders', ['status' => 'pending']) }}"
            class="bg-error-container border-4 border-on-background p-5 rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:shadow-none transition-all text-center">
            <p class="text-3xl font-black text-on-error-container">{{ $counts['pending'] }}</p>
            <p class="text-xs font-bold text-on-error-container/70 uppercase mt-1">Menunggu</p>
        </a>
        <a href="{{ route('cashier.orders', ['status' => 'paid']) }}"
            class="bg-secondary-container border-4 border-on-background p-5 rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:shadow-none transition-all text-center">
            <p class="text-3xl font-black">{{ $counts['paid'] }}</p>
            <p class="text-xs font-bold text-on-surface-variant uppercase mt-1">Dibayar</p>
        </a>
        <a href="{{ route('cashier.orders', ['status' => 'processing']) }}"
            class="bg-tertiary-container border-4 border-on-background p-5 rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:shadow-none transition-all text-center">
            <p class="text-3xl font-black text-on-tertiary-container">{{ $counts['processing'] }}</p>
            <p class="text-xs font-bold text-on-tertiary-container/70 uppercase mt-1">Dikemas</p>
        </a>
        <a href="{{ route('cashier.orders', ['status' => 'shipped']) }}"
            class="bg-primary-container border-4 border-on-background p-5 rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:shadow-none transition-all text-center">
            <p class="text-3xl font-black text-on-primary-container">{{ $counts['shipped'] }}</p>
            <p class="text-xs font-bold text-on-primary-container/70 uppercase mt-1">Dikirim</p>
        </a>
    </div>

    {{-- Filter Tabs --}}
    <div class="flex flex-wrap gap-2">
        @foreach([
            'all'        => ['label' => 'Semua ('.$counts['all'].')',           'color' => 'bg-on-background text-white'],
            'pending'    => ['label' => 'Menunggu ('.$counts['pending'].')',     'color' => 'bg-error-container text-on-error-container'],
            'paid'       => ['label' => 'Dibayar ('.$counts['paid'].')',         'color' => 'bg-secondary-container text-on-secondary-container'],
            'processing' => ['label' => 'Dikemas ('.$counts['processing'].')',   'color' => 'bg-tertiary-container text-on-tertiary-container'],
            'shipped'    => ['label' => 'Dikirim ('.$counts['shipped'].')',      'color' => 'bg-primary-container text-on-primary-container'],
            'completed'  => ['label' => 'Selesai ('.$counts['completed'].')',    'color' => 'bg-primary text-on-primary'],
            'cancelled'  => ['label' => 'Dibatalkan ('.$counts['cancelled'].')', 'color' => 'bg-outline text-white'],
        ] as $key => $tab)
        <a href="{{ route('cashier.orders', ['status' => $key]) }}"
            class="px-4 py-2 border-4 border-on-background rounded-lg font-label-bold text-sm transition-all shadow-[3px_3px_0px_0px_rgba(27,28,28,1)] hover:translate-y-0.5 hover:shadow-none
            {{ $status === $key ? $tab['color'].' shadow-none translate-y-0.5' : 'bg-white text-on-surface hover:bg-surface-container' }}">
            {{ $tab['label'] }}
        </a>
        @endforeach
    </div>

    {{-- Orders Table --}}
    <div class="bg-white border-4 border-on-background rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] overflow-hidden">
        @if($orders->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-on-background text-white">
                    <tr>
                        <th class="text-left px-6 py-4 font-label-bold text-xs uppercase tracking-wider">Pesanan</th>
                        <th class="text-left px-6 py-4 font-label-bold text-xs uppercase tracking-wider">Pelanggan</th>
                        <th class="text-left px-6 py-4 font-label-bold text-xs uppercase tracking-wider">Item</th>
                        <th class="text-left px-6 py-4 font-label-bold text-xs uppercase tracking-wider">Total</th>
                        <th class="text-left px-6 py-4 font-label-bold text-xs uppercase tracking-wider">Status</th>
                        <th class="text-left px-6 py-4 font-label-bold text-xs uppercase tracking-wider">Tanggal</th>
                        <th class="text-center px-6 py-4 font-label-bold text-xs uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-4 divide-surface-container">
                    @foreach($orders as $order)
                    <tr class="hover:bg-surface-container-lowest transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-label-bold text-primary text-sm">#{{ $order->order_number }}</p>
                            @if($order->tracking_number)
                            <p class="text-xs text-on-surface-variant font-bold mt-0.5">📦 {{ $order->tracking_number }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-label-bold text-on-surface text-sm">{{ $order->user?->name ?? 'Guest' }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $order->user?->email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                @if($order->items->first()?->product?->image)
                                <img src="{{ $order->items->first()->product->image_url }}"
                                    class="w-10 h-10 rounded-lg object-cover border-2 border-on-background" alt="">
                                @endif
                                <div>
                                    <p class="text-sm font-bold text-on-surface truncate max-w-[120px]">
                                        {{ $order->items->first()?->product?->name }}
                                    </p>
                                    @if($order->items->count() > 1)
                                    <p class="text-xs text-on-surface-variant">+{{ $order->items->count() - 1 }} lainnya</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-label-bold text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full border-2 border-on-background text-xs font-black uppercase {{ $order->status_color }}">
                                {{ $order->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold">{{ $order->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $order->created_at->format('H:i') }} WIB</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('cashier.orders.show', $order->id) }}"
                                class="inline-flex items-center gap-1 px-4 py-2 bg-primary text-on-primary border-2 border-on-background rounded-lg font-label-bold text-xs shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] hover:translate-y-0.5 hover:shadow-none transition-all">
                                <span class="material-symbols-outlined text-sm">open_in_new</span>
                                Proses
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t-4 border-surface-container">
            {{ $orders->appends(request()->query())->links() }}
        </div>
        @else
        <div class="py-20 text-center">
            <span class="material-symbols-outlined text-8xl text-on-surface-variant/30 block mb-3" style="font-variation-settings:'FILL' 1">inbox</span>
            <p class="font-headline-lg text-xl text-on-surface-variant">Tidak ada pesanan untuk filter ini</p>
        </div>
        @endif
    </div>
</div>
@endsection
