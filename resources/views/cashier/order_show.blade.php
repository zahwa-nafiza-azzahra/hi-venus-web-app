@extends('layouts.cashier')
@section('title', 'Detail Pesanan #'.$order->order_number.' | Hi Venus')
@section('page_title', 'Detail Pesanan')

@section('content')
<div class="animate-fade-in space-y-6 max-w-5xl">

    @if(session('success'))
    <div class="bg-primary-container border-4 border-on-background p-4 rounded-xl flex items-center gap-3 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]">
        <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">check_circle</span>
        <p class="font-label-bold text-on-primary-container">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Header --}}
    <div class="flex items-center gap-4 flex-wrap">
        <a href="{{ route('cashier.orders') }}"
            class="flex items-center gap-2 px-4 py-2 bg-white border-4 border-on-background rounded-lg font-label-bold text-sm shadow-[3px_3px_0px_0px_rgba(27,28,28,1)] hover:translate-y-0.5 hover:shadow-none transition-all">
            <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali
        </a>
        <div>
            <h2 class="font-headline-lg text-2xl">Pesanan #{{ $order->order_number }}</h2>
            <p class="text-xs text-on-surface-variant font-bold">{{ $order->created_at->format('d M Y, H:i') }} WIB • {{ $order->items->count() }} item</p>
        </div>
        <div class="ml-auto">
            <span class="px-4 py-2 border-4 border-on-background rounded-lg font-black text-sm uppercase {{ $order->status_color }} shadow-[3px_3px_0px_0px_rgba(27,28,28,1)]">
                {{ $order->status_label }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left: Timeline + Items + Customer --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Timeline --}}
            <div class="bg-white border-4 border-on-background p-6 rounded-xl shadow-[6px_6px_0px_0px_rgba(27,28,28,1)]">
                <h3 class="font-label-bold uppercase tracking-wider mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">local_shipping</span>
                    Timeline Pesanan
                </h3>
                @php
                $steps = [
                    ['label' => 'Pesanan Masuk',           'icon' => 'shopping_bag',   'time' => $order->created_at,   'step' => 0],
                    ['label' => 'Pembayaran Dikonfirmasi', 'icon' => 'payments',        'time' => $order->confirmed_at, 'step' => 1],
                    ['label' => 'Sedang Dikemas',          'icon' => 'inventory_2',    'time' => $order->processed_at, 'step' => 2],
                    ['label' => 'Dalam Pengiriman',        'icon' => 'local_shipping', 'time' => $order->shipped_at,   'step' => 3],
                    ['label' => 'Pesanan Selesai',         'icon' => 'check_circle',   'time' => $order->completed_at, 'step' => 4],
                ];
                $currentStep = $order->status_step;
                @endphp
                <div class="relative">
                    <div class="absolute left-5 top-0 bottom-0 w-1 bg-surface-container"></div>
                    <div class="space-y-5 relative">
                        @foreach($steps as $s)
                        @php $done = ($currentStep >= $s['step'] && $order->status !== 'cancelled'); @endphp
                        <div class="flex gap-4 items-start">
                            <div class="w-10 h-10 rounded-full border-4 border-on-background flex items-center justify-center z-10 flex-shrink-0 {{ $done ? 'bg-primary' : 'bg-surface-container' }}">
                                <span class="material-symbols-outlined text-sm {{ $done ? 'text-on-primary' : 'text-on-surface-variant' }}"
                                    style="font-variation-settings:'FILL' {{ $done ? 1 : 0 }}">{{ $s['icon'] }}</span>
                            </div>
                            <div class="pt-1">
                                <p class="font-label-bold text-sm {{ $done ? 'text-on-background' : 'text-on-surface-variant' }}">{{ $s['label'] }}</p>
                                @if($s['time'])
                                <p class="text-xs text-on-surface-variant">{{ $s['time']->format('d M Y, H:i') }} WIB</p>
                                @elseif(!$done)
                                <p class="text-xs text-on-surface-variant italic">Menunggu...</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @if($order->status === 'cancelled')
                        <div class="flex gap-4 items-start">
                            <div class="w-10 h-10 rounded-full border-4 border-error bg-error-container flex items-center justify-center z-10 flex-shrink-0">
                                <span class="material-symbols-outlined text-sm text-error" style="font-variation-settings:'FILL' 1">cancel</span>
                            </div>
                            <div class="pt-1">
                                <p class="font-label-bold text-sm text-error">Pesanan Dibatalkan</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Items --}}
            <div class="bg-white border-4 border-on-background p-6 rounded-xl shadow-[6px_6px_0px_0px_rgba(27,28,28,1)]">
                <h3 class="font-label-bold uppercase tracking-wider mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">shopping_bag</span>
                    Isi Pesanan ({{ $order->items->count() }} item)
                </h3>
                <div class="space-y-3">
                    @foreach($order->items as $item)
                    <div class="flex items-center gap-4 p-3 bg-surface-container-lowest border-2 border-on-background rounded-lg">
                        <div class="w-14 h-14 rounded-lg border-2 border-on-background overflow-hidden flex-shrink-0 bg-surface-container">
                            @if($item->product?->image)
                            <img src="{{ $item->product->image_url }}" class="w-full h-full object-cover" alt="">
                            @else
                            <span class="material-symbols-outlined w-full h-full flex items-center justify-center text-2xl text-on-surface-variant">image</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-label-bold text-sm truncate">{{ $item->product?->name }}</p>
                            @if($item->variant)
                            <div class="flex flex-wrap items-center gap-2 mt-1 mb-1">
                                <span class="bg-surface-variant text-on-surface text-[10px] px-2 py-0.5 rounded-full font-bold">Size: {{ $item->variant->size }}</span>
                                <span class="bg-surface-variant text-on-surface text-[10px] px-2 py-0.5 rounded-full flex items-center gap-1 font-bold">
                                    Color: {{ $item->variant->color }}
                                    @if($item->variant->color_hex)
                                        <span class="w-2 h-2 rounded-full border border-on-background inline-block" style="background-color: {{ $item->variant->color_hex }}"></span>
                                    @endif
                                </span>
                            </div>
                            @endif
                            <p class="text-xs text-on-surface-variant">Qty: {{ $item->quantity }}</p>
                        </div>
                        <p class="font-label-bold text-primary text-sm flex-shrink-0">
                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </p>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4 pt-4 border-t-2 border-dashed border-on-background space-y-1">
                    <div class="flex justify-between text-sm font-bold">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->total_amount - $order->shipping_cost + $order->discount_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm font-bold">
                        <span>Ongkir ({{ $order->shipping_method ?? '-' }})</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    @if($order->discount_amount > 0)
                    <div class="flex justify-between text-sm font-bold text-tertiary">
                        <span>Diskon Voucher</span>
                        <span>- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between font-black text-lg pt-2 border-t-2 border-on-background">
                        <span>TOTAL</span>
                        <span class="text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Customer --}}
            <div class="bg-white border-4 border-on-background p-6 rounded-xl shadow-[6px_6px_0px_0px_rgba(27,28,28,1)]">
                <h3 class="font-label-bold uppercase tracking-wider mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">person</span>
                    Info Pelanggan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-surface-container-lowest border-2 border-on-background p-4 rounded-lg">
                        <p class="text-xs font-black uppercase text-on-surface-variant mb-1">Nama</p>
                        <p class="font-label-bold">{{ $order->user?->name ?? '-' }}</p>
                    </div>
                    <div class="bg-surface-container-lowest border-2 border-on-background p-4 rounded-lg">
                        <p class="text-xs font-black uppercase text-on-surface-variant mb-1">Email</p>
                        <p class="font-label-bold">{{ $order->user?->email ?? '-' }}</p>
                    </div>
                    <div class="bg-surface-container-lowest border-2 border-on-background p-4 rounded-lg">
                        <p class="text-xs font-black uppercase text-on-surface-variant mb-1">No. HP</p>
                        <p class="font-label-bold">{{ $order->user?->phone ?? $order->recipient_phone ?? '-' }}</p>
                    </div>
                    <div class="bg-surface-container-lowest border-2 border-on-background p-4 rounded-lg">
                        <p class="text-xs font-black uppercase text-on-surface-variant mb-1">Metode Bayar</p>
                        <p class="font-label-bold">{{ $order->payment_method ?? '-' }}</p>
                    </div>
                    @if($order->shipping_address)
                    <div class="bg-surface-container-lowest border-2 border-on-background p-4 rounded-lg md:col-span-2">
                        <p class="text-xs font-black uppercase text-on-surface-variant mb-1">Alamat Pengiriman</p>
                        <p class="font-label-bold leading-relaxed">{{ $order->shipping_address }}</p>
                    </div>
                    @endif
                    @if($order->notes)
                    <div class="bg-secondary-fixed border-2 border-on-background p-4 rounded-lg md:col-span-2">
                        <p class="text-xs font-black uppercase text-on-surface-variant mb-1">Catatan Pembeli</p>
                        <p class="font-bold italic text-sm">{{ $order->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right: Action Panel --}}
        <div class="space-y-6">
            {{-- Update Status --}}
            @if(!in_array($order->status, ['completed', 'cancelled']))
            <div class="bg-white border-4 border-on-background p-6 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)]">
                <h3 class="font-label-bold uppercase tracking-wider mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">edit_note</span>
                    Update Status
                </h3>
                <form action="{{ route('cashier.orders.update_status', $order->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @php
                    $nextStatuses = match($order->status) {
                        'pending'    => ['paid' => '✅ Konfirmasi Pembayaran', 'cancelled' => '❌ Batalkan'],
                        'paid'       => ['processing' => '📦 Mulai Kemas', 'cancelled' => '❌ Batalkan'],
                        'processing' => ['shipped' => '🚚 Tandai Dikirim', 'cancelled' => '❌ Batalkan'],
                        'shipped'    => ['completed' => '🎉 Tandai Selesai'],
                        default      => [],
                    };
                    @endphp
                    <div>
                        <label class="block font-label-bold text-xs uppercase text-on-surface-variant mb-2">Status Baru</label>
                        <select name="status" class="w-full border-4 border-on-background p-3 rounded-lg font-label-bold focus:outline-none focus:border-primary bg-surface-container-lowest">
                            @foreach($nextStatuses as $val => $label)
                            <option value="{{ $val }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-label-bold text-xs uppercase text-on-surface-variant mb-2">No. Resi (opsional)</label>
                        <input type="text" name="tracking_number" value="{{ $order->tracking_number }}"
                            placeholder="Contoh: JNE1234567890"
                            class="w-full border-4 border-on-background p-3 rounded-lg font-label-bold focus:outline-none focus:border-primary bg-surface-container-lowest placeholder:opacity-40">
                    </div>
                    <div>
                        <label class="block font-label-bold text-xs uppercase text-on-surface-variant mb-2">Catatan untuk Pembeli (opsional)</label>
                        <textarea name="cashier_note" rows="3" placeholder="Tulis catatan..."
                            class="w-full border-4 border-on-background p-3 rounded-lg font-label-bold focus:outline-none focus:border-primary bg-surface-container-lowest placeholder:opacity-40 resize-none">{{ $order->cashier_note }}</textarea>
                    </div>
                    <button type="submit"
                        class="w-full py-4 bg-primary text-on-primary border-4 border-on-background rounded-xl font-black shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:shadow-none transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">update</span>
                        Update Pesanan
                    </button>
                </form>
            </div>
            @else
            <div class="bg-surface-container-low border-4 border-dashed border-on-background p-6 rounded-xl text-center">
                <span class="material-symbols-outlined text-5xl text-on-surface-variant/40 block mb-2" style="font-variation-settings:'FILL' 1">
                    {{ $order->status === 'completed' ? 'task_alt' : 'cancel' }}
                </span>
                <p class="font-label-bold text-on-surface-variant">Pesanan sudah {{ $order->status_label }}</p>
            </div>
            @endif

            {{-- Tracking number display --}}
            @if($order->tracking_number)
            <div class="bg-primary-container border-4 border-on-background p-5 rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]">
                <p class="text-xs font-black uppercase text-on-primary-container/70 mb-1 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">package_2</span> No. Resi
                </p>
                <p class="font-black text-lg text-on-primary-container">{{ $order->tracking_number }}</p>
            </div>
            @endif

            {{-- Cashier note display --}}
            @if($order->cashier_note)
            <div class="bg-secondary-fixed border-4 border-on-background p-5 rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]">
                <p class="text-xs font-black uppercase text-on-surface-variant mb-1 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">sticky_note_2</span> Catatan Kasir
                </p>
                <p class="font-bold italic text-sm">{{ $order->cashier_note }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
