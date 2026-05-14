@extends('layouts.app')

@section('title', 'Keranjang Kamu 💖 | Hi Venus')

@section('body_class', 'kawaii-stripes')

@push('styles')
<style>
    .kawaii-stripes {
        background-color: #ffd8eb;
        background-image: repeating-linear-gradient(45deg, transparent, transparent 20px, rgba(158, 53, 123, 0.1) 20px, rgba(158, 53, 123, 0.1) 40px);
    }
    .sticker-rotate-left { transform: rotate(-3deg); }
    .sticker-rotate-right { transform: rotate(3deg); }
    .comic-border { border: 4px solid #1b1c1c; }
    .comic-shadow { box-shadow: 8px 8px 0px 0px rgba(27,28,28,1); }
</style>
@endpush

@section('content')
<main class="max-w-[1200px] mx-auto px-margin-mobile md:px-margin-desktop py-12">
    <!-- Title Section -->
    <div class="mb-12 relative animate-fade-in-down">
        <h1 class="font-headline-xl text-headline-xl text-primary inline-block bg-white px-8 py-4 border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] sticker-rotate-left">
            Keranjang Kamu 💖
        </h1>
        <div class="absolute -top-6 -right-6 hidden md:block animate-float">
            <span class="material-symbols-outlined text-secondary text-6xl opacity-50">auto_awesome</span>
        </div>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        <!-- Items List -->
        <div class="lg:col-span-8 space-y-6">
            @foreach(session('cart') as $id => $details)
            <div class="bg-surface-container-lowest border-4 border-on-background shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] p-6 flex flex-col md:flex-row items-center gap-6 group hover:translate-x-1 hover:translate-y-1 hover:shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] transition-all animate-fade-in-up">
                <div class="w-32 h-32 flex-shrink-0 bg-primary-fixed border-2 border-on-background sticker-rotate-right overflow-hidden">
                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . ($details['image'] ?? '')) }}" onerror="this.src='https://lh3.googleusercontent.com/aida-public/AB6AXuC5RyDys8VL3YqIOOgeEDYk8hRy2QwYwoMZOCjbxjiBe-XbfoJApDPdRc8KnsjAe3M5zLSH1i9ZxKQLjUH-SjykjKvex6zuVYPbSdGtEXLPJDEFQixIGhRViepgCEXlcCX9WY0oGKhSAw7uUighIIPrD7dTQKHJjeu7x53gQ00abxTWUZQmKEs2F9gNY6OW-i8qCzwOQG4GX_4xsyCrEh3dOmohjniqxHNHMUmNQFchd_DkjCPsN921gcBpmcIZ21sAo6PgpfujKuIf'"/>
                </div>
                <div class="flex-grow text-center md:text-left">
                    <h3 class="font-headline-lg text-headline-lg text-primary mb-1">{{ $details['name'] }}</h3>
                    <p class="font-label-bold text-label-bold text-on-surface-variant mb-4">Harga Satuan: Rp {{ number_format($details['price'], 0, ',', '.') }}</p>
                    <div class="flex items-center justify-center md:justify-start gap-4">
                        <span class="font-price-display text-price-display text-secondary">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="flex flex-col items-center md:items-end gap-4">
                    <div class="flex items-center border-4 border-on-background bg-white shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]">
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="quantity" value="{{ $details['quantity'] - 1 }}">
                            <button class="p-2 hover:bg-surface-variant active:bg-secondary-container transition-colors" {{ $details['quantity'] <= 1 ? 'disabled' : '' }}>
                                <span class="material-symbols-outlined">remove</span>
                            </button>
                        </form>
                        <span class="px-4 font-headline-lg text-headline-lg border-x-4 border-on-background">{{ $details['quantity'] }}</span>
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="quantity" value="{{ $details['quantity'] + 1 }}">
                            <button class="p-2 hover:bg-surface-variant active:bg-secondary-container transition-colors">
                                <span class="material-symbols-outlined">add</span>
                            </button>
                        </form>
                    </div>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        <button class="p-2 bg-error text-on-error border-2 border-on-background hover:scale-110 active:scale-95 transition-transform flex items-center gap-1">
                            <span class="material-symbols-outlined">delete</span>
                            <span class="font-label-bold">Hapus</span>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Summary Sidebar -->
        <div class="lg:col-span-4">
            <div class="bg-white border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] p-8 sticky top-28 animate-fade-in-right">
                <h2 class="font-headline-lg text-headline-lg text-primary mb-6 border-b-4 border-on-background pb-2">Ringkasan</h2>
                <div class="space-y-4 mb-8">
                    @php $total = 0; foreach((array) session('cart') as $id => $details) { $total += $details['price'] * $details['quantity']; } @endphp
                    <div class="flex justify-between items-center">
                        <span class="text-on-surface-variant font-label-bold">Subtotal ({{ count(session('cart')) }} item)</span>
                        <span class="font-body-lg text-on-surface">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-on-surface-variant font-label-bold">Estimasi Pengiriman</span>
                        <span class="font-body-lg text-on-surface">Rp 20.000</span>
                    </div>
                    <div class="pt-4 border-t-4 border-dashed border-outline-variant flex justify-between items-center">
                        <span class="font-headline-lg text-headline-lg text-on-background">Total</span>
                        <span class="font-price-display text-headline-lg text-secondary">Rp {{ number_format($total + 20000, 0, ',', '.') }}</span>
                    </div>
                </div>
                <a href="{{ route('checkout.shipping') }}" class="w-full bg-primary-container text-on-primary-container border-4 border-on-background py-6 px-4 font-headline-lg text-headline-lg shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] flex items-center justify-center gap-2 hover:translate-x-1 hover:translate-y-1 hover:shadow-none active:translate-y-2 active:shadow-none transition-all group">
                    Lanjut ke Checkout
                    <span class="material-symbols-outlined group-hover:translate-x-2 transition-transform">arrow_forward</span>
                </a>
                <div class="mt-8 flex items-center gap-4 p-4 bg-secondary-fixed border-2 border-on-background sticker-rotate-right">
                    <span class="material-symbols-outlined text-on-secondary-fixed">local_offer</span>
                    <p class="text-label-bold text-on-secondary-fixed">Gunakan kode promo untuk diskon ekstra!</p>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-20 bg-white border-4 border-dashed border-on-background rounded-3xl comic-shadow">
        <span class="material-symbols-outlined text-8xl text-primary-container mb-6 animate-bounce">shopping_basket</span>
        <h2 class="font-headline-xl text-headline-xl text-on-background mb-4">Wah, keranjangmu kosong! 🌈</h2>
        <p class="font-body-lg text-on-surface-variant mb-10">Ayo cari barang-barang lucu untuk mengisi harimu!</p>
        <a href="{{ route('home') }}" class="bg-primary text-on-primary border-4 border-on-background px-12 py-4 rounded-full font-headline-lg shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:shadow-none transition-all inline-block">Mulai Belanja ✨</a>
    </div>
    @endif
</main>
@endsection
