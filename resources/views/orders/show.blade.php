@extends('layouts.app')

@section('title', 'Detail Pesanan | Hi Venus')

@section('body_class', 'bg-[#fcf9f8]')

@section('content')
<main class="max-w-6xl mx-auto px-margin-mobile md:px-margin-desktop py-12 animate-fade-in">
    <!-- Header Section -->
    <div class="relative mb-12 flex flex-col md:flex-row md:items-end gap-4">
        <div class="flex-grow">
            <h1 class="font-headline-xl text-headline-xl text-primary flex items-center gap-3">
                Detail Pesanan 
                <span class="material-symbols-outlined text-5xl text-secondary-container bg-on-background rounded-full p-2 border-2 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]">receipt_long</span>
            </h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-2">Terima kasih sudah berbelanja barang lucu di Hi Venus! ✨</p>
        </div>
        <!-- Payment Status Badge -->
        <div class="inline-block bg-tertiary-container border-4 border-on-background px-6 py-3 rounded-xl shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] -rotate-2">
            <p class="font-label-bold text-label-bold text-on-tertiary-container uppercase tracking-wider">Status: {{ strtoupper($order->status) }} ✅</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
        <!-- Left Column: Order Timeline & Address -->
        <div class="lg:col-span-2 space-y-gutter">
            <!-- Shipping Timeline Bento Box -->
            <section class="bg-white border-4 border-on-background p-8 rounded-lg shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] relative overflow-hidden">
                <div class="absolute -top-4 -right-4 w-16 h-16 bg-primary-container border-4 border-on-background rounded-full flex items-center justify-center rotate-12">
                    <span class="material-symbols-outlined text-on-primary-container">local_shipping</span>
                </div>
                <h2 class="font-headline-lg text-headline-lg text-on-background mb-8">Status Pesanan Kamu</h2>

                @php
                $isPickup = $order->shipping_method === 'Ambil di Toko';
                $timelineSteps = [
                    ['label' => 'Pesanan Masuk',           'icon' => 'shopping_bag',   'time' => $order->created_at,   'step' => 0],
                    ['label' => 'Pembayaran Dikonfirmasi', 'icon' => 'payments',        'time' => $order->confirmed_at, 'step' => 1],
                    ['label' => 'Sedang Dikemas 🎀',       'icon' => 'inventory_2',    'time' => $order->processed_at, 'step' => 2],
                    ['label' => $isPickup ? 'Siap Diambil 🛍️' : 'Dalam Pengiriman 🚚', 'icon' => $isPickup ? 'storefront' : 'local_shipping', 'time' => $order->shipped_at,   'step' => 3],
                    ['label' => $isPickup ? 'Sudah Diambil 🎉' : 'Pesanan Selesai 🎉',  'icon' => 'check_circle',   'time' => $order->completed_at, 'step' => 4],
                ];
                $currentStep = $order->status_step;
                @endphp

                @if($order->status === 'cancelled')
                <div class="flex gap-4 items-center bg-error-container border-4 border-error p-5 rounded-xl">
                    <span class="material-symbols-outlined text-error text-4xl" style="font-variation-settings:'FILL' 1">cancel</span>
                    <div>
                        <p class="font-label-bold text-on-error-container text-lg">Pesanan Dibatalkan</p>
                        @if($order->cashier_note)
                        <p class="text-sm text-on-error-container/80 mt-1">{{ $order->cashier_note }}</p>
                        @endif
                    </div>
                </div>
                @else
                <div class="space-y-6 relative">
                    <div class="absolute left-[19px] top-2 bottom-2 w-1 bg-on-background opacity-10"></div>
                    @foreach($timelineSteps as $ts)
                    @php $done = ($currentStep >= $ts['step']); $active = ($currentStep === $ts['step']); @endphp
                    <div class="flex gap-6 relative">
                        <div class="w-10 h-10 rounded-full border-4 border-on-background z-10 flex items-center justify-center shrink-0
                            {{ $done ? 'bg-secondary-container' : 'bg-surface-container' }} {{ $active ? 'animate-pulse ring-4 ring-primary ring-offset-2' : '' }}">
                            <span class="material-symbols-outlined text-xl {{ $done ? 'text-on-secondary-container' : 'text-on-surface-variant' }}"
                                style="font-variation-settings:'FILL' {{ $done ? 1 : 0 }}">{{ $ts['icon'] }}</span>
                        </div>
                        <div>
                            <p class="font-label-bold text-label-bold {{ $done ? 'text-on-background' : 'text-on-surface-variant' }} {{ $active ? '!text-primary font-black uppercase' : '' }}">
                                {{ $ts['label'] }}
                                @if($active) <span class="text-xs ml-1 normal-case font-normal opacity-70">← saat ini</span> @endif
                            </p>
                            @if($ts['time'])
                            <p class="font-body-md text-body-md text-on-surface-variant">{{ $ts['time']->format('d M Y - H:i') }} WIB</p>
                            @elseif(!$done)
                            <p class="font-body-md text-body-md text-on-surface-variant italic opacity-50">Menunggu proses kasir...</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Tracking Number --}}
                @if($order->tracking_number)
                <div class="mt-6 p-4 bg-primary-container border-2 border-on-background rounded-xl flex items-center gap-3">
                    <span class="material-symbols-outlined text-on-primary-container text-2xl" style="font-variation-settings:'FILL' 1">package_2</span>
                    <div>
                        <p class="text-xs font-black uppercase text-on-primary-container/70">No. Resi Pengiriman</p>
                        <p class="font-black text-lg text-on-primary-container">{{ $order->tracking_number }}</p>
                    </div>
                </div>
                @endif

                {{-- Cashier Note --}}
                @if($order->cashier_note && $order->status !== 'cancelled')
                <div class="mt-4 p-4 bg-secondary-fixed border-2 border-on-background rounded-xl">
                    <p class="text-xs font-black uppercase text-on-surface-variant mb-1">📝 Catatan dari Kasir</p>
                    <p class="font-bold italic text-sm">{{ $order->cashier_note }}</p>
                </div>
                @endif
            </section>


            <!-- Address & Payment Method -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                @if($order->shipping_method === 'Ambil di Toko')
                <section class="bg-secondary-fixed border-4 border-on-background p-6 rounded-lg shadow-[6px_6px_0px_0px_rgba(27,28,28,1)]">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary">storefront</span>
                        <h3 class="font-label-bold text-label-bold text-on-background uppercase">Lokasi Pengambilan (Toko)</h3>
                    </div>
                    <p class="font-body-md text-body-md text-on-background font-bold">Toko Hi Venus Boutique 🎀</p>
                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                        Jl. Venus Raya No. 12, Lantai 2, Ruko Pastel Blossom<br/>
                        Kecamatan Kawaii, Jakarta Selatan<br/>
                        DKI Jakarta, 12130
                    </p>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-2">📞 WhatsApp Toko: +62 812-3456-7890</p>
                </section>
                @else
                <section class="bg-surface-container-low border-4 border-on-background p-6 rounded-lg shadow-[6px_6px_0px_0px_rgba(27,28,28,1)]">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary">location_on</span>
                        <h3 class="font-label-bold text-label-bold text-on-background uppercase">Alamat Pengiriman</h3>
                    </div>
                    <p class="font-body-md text-body-md text-on-background font-bold">{{ auth()->user()->name }}</p>
                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                        Jl. Strawberry No. 88, Cluster Pastel Blok C3<br/>
                        Kecamatan Harajuku, Jakarta Selatan<br/>
                        DKI Jakarta, 12345
                    </p>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-2">📞 {{ auth()->user()->phone ?? '+62 8xx-xxxx-xxxx' }}</p>
                </section>
                @endif
                <section class="bg-surface-container-low border-4 border-on-background p-6 rounded-lg shadow-[6px_6px_0px_0px_rgba(27,28,28,1)]">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary">payments</span>
                        <h3 class="font-label-bold text-label-bold text-on-background uppercase">Metode Pembayaran</h3>
                    </div>
                    <div class="bg-white border-2 border-on-background p-3 rounded-lg flex items-center justify-between mb-4">
                        <span class="font-label-bold text-label-bold text-on-background uppercase">{{ $order->payment_method }}</span>
                        <span class="material-symbols-outlined text-secondary">verified_user</span>
                    </div>
                    <p class="font-body-md text-body-md text-on-surface-variant">Nomor Pesanan:</p>
                    <p class="font-label-bold text-label-bold text-on-background text-lg mb-4">#{{ $order->order_number }}</p>
                    
                    @if($order->status === 'pending')
                    <div class="bg-primary-container text-on-primary-container p-4 rounded-lg border-2 border-on-background mt-4">
                        <p class="font-label-bold text-label-bold mb-2">📢 Instruksi Pembayaran:</p>
                        @if($order->payment_method === 'Bank Transfer')
                            <p class="font-body-md text-sm mb-1">Transfer ke Rekening BCA:</p>
                            <p class="font-headline-lg text-lg tracking-widest font-black">123-456-7890</p>
                            <p class="font-body-md text-xs mt-1">a/n Hi Venus Official</p>
                        @else
                            <p class="font-body-md text-sm mb-1">Transfer ke GoPay / OVO / DANA:</p>
                            <p class="font-headline-lg text-lg tracking-widest font-black">0812-3456-7890</p>
                            <p class="font-body-md text-xs mt-1">a/n Hi Venus Official</p>
                        @endif
                        <div class="mt-4 p-2 bg-white rounded border-2 border-on-background">
                            <p class="font-body-md text-xs text-on-surface text-center">
                                Silakan bayar sesuai <b>Total Harga</b>.<br>
                                Sistem kami akan memverifikasi otomatis dalam 10 menit setelah transfer. 💸
                            </p>
                        </div>
                    </div>
                    @endif
                </section>
            </div>
        </div>

        <!-- Right Column: Order Summary (The Struk) -->
        <div class="space-y-gutter">
            <section class="bg-white border-4 border-on-background p-6 rounded-lg shadow-[10px_10px_0px_0px_rgba(27,28,28,1)] relative">
                <div class="text-center mb-6 border-b-2 border-dashed border-outline-variant pb-4">
                    <p class="font-headline-lg text-headline-lg text-primary tracking-tighter">Hi Venus</p>
                    <p class="font-label-bold text-label-bold text-on-surface-variant opacity-70">Struk Belanja Lucu</p>
                </div>
                
                <!-- Products List -->
                <div class="space-y-6 mb-6">
                    @foreach($order->items as $item)
                    <div class="flex gap-4">
                        <div class="w-16 h-16 bg-surface-variant border-2 border-on-background rounded-lg flex-shrink-0 overflow-hidden {{ $loop->odd ? 'rotate-2' : '-rotate-2' }}">
                            <img alt="{{ $item->product->name }}" class="w-full h-full object-cover" src="{{ $item->product->image ? $item->product->image_url : 'https://api.dicebear.com/7.x/shapes/svg?seed='.$item->product->name }}">
                        </div>
                        <div class="flex-grow">
                            <p class="font-label-bold text-label-bold text-on-background truncate">{{ $item->product->name }}</p>
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
                            <p class="font-body-md text-xs text-on-surface-variant">Qty: {{ $item->quantity }}</p>
                            <p class="font-price-display text-primary">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Totals -->
                <div class="border-t-2 border-dashed border-outline-variant pt-4 space-y-2">
                    <div class="flex justify-between font-body-md text-sm">
                        <span>Subtotal Produk</span>
                        <span class="font-bold">Rp {{ number_format($order->total_amount - $order->shipping_cost + $order->discount_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between font-body-md text-sm">
                        <span>Ongkos Kirim ({{ $order->shipping_method ?? 'Ekspedisi' }})</span>
                        <span class="font-bold">Rp {{ number_format($order->shipping_cost ?? 15000, 0, ',', '.') }}</span>
                    </div>
                    @if($order->discount_amount > 0)
                    <div class="flex justify-between font-body-md text-sm text-tertiary">
                        <span>Diskon Voucher</span>
                        <span class="font-bold">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between pt-4 border-t-2 border-on-background">
                        <span class="font-headline-lg text-headline-lg text-on-background">TOTAL</span>
                        <span class="font-headline-lg text-headline-lg text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </section>

            <!-- Download CTA -->
            <div class="pt-4 space-y-4">
                <button onclick="window.location.href='{{ route('orders.pdf', $order->id) }}'" class="w-full bg-secondary-container text-on-secondary-container font-headline-lg text-headline-lg-mobile md:text-headline-lg py-6 rounded-lg border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] flex items-center justify-center gap-3 hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all duration-100 group">
                    Unduh Struk PDF 📄
                    <span class="material-symbols-outlined text-3xl group-hover:rotate-12 transition-transform">download</span>
                </button>
                @if($order->status === 'pending')
                <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" onclick="return confirm('Yakin mau membatalkan pesanan ini? 🥺')" class="w-full bg-error-container text-on-error-container font-headline-lg text-headline-lg-mobile md:text-headline-lg py-6 rounded-lg border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] flex items-center justify-center gap-3 hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all duration-100">
                        Batalkan Pesanan ❌
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Back to Orders -->
    <div class="mt-12 text-center">
        <a href="{{ route('orders.index') }}" class="font-black text-primary underline underline-offset-8 decoration-4 hover:text-on-primary-fixed-variant transition-colors uppercase tracking-widest text-sm">
            Kembali ke Riwayat Pembelian
        </a>
    </div>
</main>
@endsection
