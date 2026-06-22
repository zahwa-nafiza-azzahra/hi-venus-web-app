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
                <h2 class="font-headline-lg text-headline-lg text-on-background mb-8">Timeline Pengiriman</h2>
                <div class="space-y-6 relative">
                    <div class="absolute left-[19px] top-2 bottom-2 w-1 bg-on-background opacity-20"></div>
                    
                    <div class="flex gap-6 relative">
                        <div class="w-10 h-10 rounded-full bg-secondary-container border-4 border-on-background z-10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-on-secondary-container text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        </div>
                        <div>
                            <p class="font-label-bold text-label-bold text-on-background">Pesanan Diterima & Dibayar</p>
                            <p class="font-body-md text-body-md text-on-surface-variant">{{ $order->created_at->format('d M Y - H:i') }} WIB</p>
                        </div>
                    </div>

                    <div class="flex gap-6 relative">
                        <div class="w-10 h-10 rounded-full bg-secondary-container border-4 border-on-background z-10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-on-secondary-container text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        </div>
                        <div>
                            <p class="font-label-bold text-label-bold text-on-background">Sedang Dikemas (Aesthetic Wrap! 🎀)</p>
                            <p class="font-body-md text-body-md text-on-surface-variant">Sudah Siap!</p>
                        </div>
                    </div>

                    <div class="flex gap-6 relative">
                        <div class="w-10 h-10 rounded-full bg-primary-container border-4 border-on-background z-10 flex items-center justify-center shrink-0 animate-pulse">
                            <span class="material-symbols-outlined text-on-primary-container text-xl">rocket_launch</span>
                        </div>
                        <div>
                            <p class="font-label-bold text-label-bold text-primary font-black uppercase">Dalam Perjalanan ke Rumahmu!</p>
                            <p class="font-body-md text-body-md text-on-surface-variant">Estimasi tiba hari ini!</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Address & Payment Method -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
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
                <button class="w-full bg-secondary-container text-on-secondary-container font-headline-lg text-headline-lg-mobile md:text-headline-lg py-6 rounded-lg border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] flex items-center justify-center gap-3 hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all duration-100 group">
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
