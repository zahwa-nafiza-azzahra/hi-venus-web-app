@extends('layouts.cashier')

@section('title', 'Verifikasi Pickup | Hi Venus')
@section('page_title', 'Verifikasi Pickup Online')

@section('content')
<div class="animate-fade-in">
    <!-- Search Section -->
    <section class="mb-10">
        <form action="{{ route('cashier.pickup') }}" method="GET" class="bg-surface-container-low border-4 border-on-background p-8 rounded-xl shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] relative overflow-hidden">
            <!-- Decorative Sparkles -->
            <span class="material-symbols-outlined absolute top-2 right-2 text-primary opacity-20 text-4xl">auto_awesome</span>
            <span class="material-symbols-outlined absolute bottom-2 left-2 text-tertiary opacity-20 text-4xl">star</span>
            
            <label class="block font-label-bold text-label-bold mb-4 text-on-surface-variant tracking-widest">INPUT KODE PICKUP / NOMOR PESANAN</label>
            <div class="flex flex-col md:flex-row gap-6">
                <div class="relative flex-1">
                    <input name="order_number" class="w-full bg-white border-4 border-on-background p-5 rounded-xl text-headline-lg-mobile font-headline-lg-mobile focus:ring-4 focus:ring-tertiary-container focus:outline-none placeholder:opacity-30 uppercase" placeholder="Contoh: VENUS-XXXXX" type="text" value="{{ request('order_number') }}"/>
                    <span class="absolute right-5 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant text-4xl">qr_code_scanner</span>
                </div>
                <button type="submit" class="bg-tertiary-container text-on-tertiary-fixed font-black px-10 py-5 border-4 border-on-background shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] rounded-xl hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-3xl">search</span>
                    CARI PESANAN
                </button>
            </div>
        </form>
    </section>

    @if(request()->has('order_number'))
        @if(!$order)
            <div class="bg-error-container text-on-error-container p-6 rounded-xl border-4 border-error mb-8 shadow-sm">
                <h4 class="font-bold flex items-center gap-2 text-lg">
                    <span class="material-symbols-outlined">error</span>
                    Pesanan Tidak Ditemukan!
                </h4>
                <p class="mt-2">Pastikan nomor pesanan yang dimasukkan sudah benar.</p>
            </div>
        @else
            <!-- Result Grid (Bento Style) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Order Status & Customer -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Status Card -->
                    <div class="bg-white border-4 border-on-background p-8 rounded-xl shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] flex items-center justify-between">
                        <div>
                            <p class="text-on-surface-variant font-label-bold text-label-bold tracking-widest">STATUS PESANAN</p>
                            <div class="flex items-center gap-3 mt-2">
                                <span class="w-5 h-5 {{ $order->status_color }} rounded-full border-4 border-on-background @if($order->status === 'shipped') animate-pulse @endif"></span>
                                <h3 class="font-headline-lg-mobile text-headline-lg-mobile text-secondary italic">{{ $order->status_label }}</h3>
                            </div>
                        </div>
                        <div class="rotate-3 bg-primary-fixed border-4 border-on-background px-4 py-2 rounded-full text-on-primary-fixed-variant font-black text-sm shadow-sm uppercase">
                            {{ $order->shipping_method ?: 'Kurir' }} 🚀
                        </div>
                    </div>

                    @if($order->shipping_method !== 'Ambil di Toko')
                        <div class="bg-error-container text-on-error-container p-4 rounded-xl border-4 border-error shadow-sm">
                            <h4 class="font-bold flex items-center gap-2">
                                <span class="material-symbols-outlined">warning</span>
                                Perhatian!
                            </h4>
                            <p class="mt-1">Pesanan ini BUKAN untuk diambil di toko (Metode: <span class="font-bold uppercase">{{ $order->shipping_method ?: 'Tidak diketahui / Kurir' }}</span>).</p>
                        </div>
                    @endif

                    <!-- Details Card -->
                    <div class="bg-white border-4 border-on-background p-10 rounded-xl shadow-[12px_12px_0px_0px_rgba(27,28,28,1)] relative">
                        <h4 class="font-headline-lg text-headline-lg mb-8 border-b-4 border-surface-variant pb-6 flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">shopping_bag</span>
                            Detail Isi Pesanan
                        </h4>
                        <div class="space-y-8">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-surface-container-low/50 p-4 rounded-xl border-2 border-dashed border-on-background">
                                <span class="text-on-surface-variant font-label-bold text-label-bold uppercase">PELANGGAN</span>
                                <span class="font-headline-lg-mobile text-headline-lg-mobile text-primary italic font-black">{{ $order->recipient_name ?? $order->user->name }} ★</span>
                            </div>

                            <div class="space-y-6">
                                <span class="text-on-surface-variant font-label-bold text-label-bold block mb-4 uppercase tracking-widest">DAFTAR BARANG</span>
                                
                                @foreach($order->items as $index => $item)
                                    <div class="flex items-center gap-6 p-6 bg-white border-4 border-on-background rounded-2xl hover:{{ $index % 2 == 0 ? 'rotate-1' : '-rotate-1' }} transition-transform">
                                        <div class="w-20 h-20 bg-{{ $index % 2 == 0 ? 'primary-fixed' : 'secondary-container' }} border-4 border-on-background rounded-xl flex items-center justify-center overflow-hidden {{ $index % 2 == 0 ? 'rotate-3' : '-rotate-3' }}">
                                            @if($item->product->image)
                                                <img class="w-full h-full object-cover" src="{{ str_starts_with($item->product->image, 'http') ? $item->product->image : Storage::url($item->product->image) }}"/>
                                            @else
                                                <span class="material-symbols-outlined text-4xl opacity-50">image</span>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-headline-lg text-xl italic">{{ $item->product->name }}</p>
                                            <p class="text-on-surface-variant font-bold">Qty: {{ $item->quantity }} • Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                            @if($item->variant)
                                                <p class="text-xs text-on-surface-variant mt-1">Var: {{ $item->variant->size }} | {{ $item->variant->color }}</p>
                                            @endif
                                        </div>
                                        <span class="font-price-display text-price-display text-primary">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Summary & CTA -->
                <div class="space-y-8">
                    <!-- Total Card -->
                    <div class="bg-secondary-container border-4 border-on-background p-8 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] text-on-secondary-fixed">
                        <p class="font-label-bold text-label-bold opacity-70 tracking-widest">TOTAL TAGIHAN</p>
                        <h2 class="font-headline-xl text-5xl italic mt-2">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h2>
                        <div class="mt-6 pt-6 border-t-4 border-on-secondary-fixed-variant border-dashed">
                            <p class="flex justify-between font-bold"><span>Subtotal</span> <span>Rp {{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}</span></p>
                            @if($order->discount_amount > 0)
                                <p class="flex justify-between font-bold text-xs mt-2 text-error"><span>Diskon</span> <span>- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span></p>
                            @endif
                        </div>
                    </div>

                    <!-- Action Card -->
                    <div class="bg-white border-4 border-on-background p-8 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] text-center">
                        <div class="mb-8 rotate-6 inline-block bg-surface-variant border-4 border-on-background p-6 rounded-2xl shadow-sm">
                            <span class="material-symbols-outlined text-6xl text-primary" style="font-variation-settings: 'FILL' 1;">{{ $order->status === 'completed' ? 'check_circle' : 'verified_user' }}</span>
                        </div>
                        
                        @if($order->status === 'completed')
                            <p class="text-primary mb-8 font-bold leading-relaxed text-lg">Pesanan ini sudah selesai diambil.</p>
                        @elseif($order->shipping_method !== 'Ambil di Toko')
                            <p class="text-error mb-8 font-bold leading-relaxed text-lg">Bukan pesanan pickup!</p>
                        @else
                            <p class="text-on-surface-variant mb-8 font-bold leading-relaxed">Pastikan semua barang sudah sesuai sebelum konfirmasi serah terima.</p>
                            <form action="{{ route('cashier.orders.update_status', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="w-full py-8 bg-primary text-on-primary font-black text-2xl border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] rounded-2xl hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all active:scale-95">
                                    KONFIRMASI PICKUP 💖
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('cashier.pickup') }}" class="block w-full py-4 mt-6 bg-white text-error font-bold border-4 border-error rounded-xl hover:bg-error-container transition-colors text-center">
                            Batalkan Sesi
                        </a>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
@endsection
