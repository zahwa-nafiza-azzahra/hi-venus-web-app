@extends('layouts.app')

@section('title', 'Dashboard Saya | Hi Venus')

@section('body_class', 'polka-bg')

@push('styles')
    <style>
        .polka-bg {
            background-color: #fcf9f8;
            background-image: radial-gradient(#fdd73b 4px, transparent 4px);
            background-size: 32px 32px;
        }

        .comic-border {
            border: 4px solid #1b1c1c;
        }

        .comic-shadow {
            box-shadow: 8px 8px 0px 0px rgba(27, 28, 28, 1);
        }

        .comic-shadow-sm {
            box-shadow: 4px 4px 0px 0px rgba(27, 28, 28, 1);
        }

        .press-effect:active {
            transform: translate(4px, 4px);
            box-shadow: 0px 0px 0px 0px rgba(27, 28, 28, 1);
        }

        .sticker-rotate-left {
            transform: rotate(-3deg);
        }

        .sticker-rotate-right {
            transform: rotate(3deg);
        }
    </style>
@endpush

@section('content')
    <main class="max-w-7xl mx-auto px-margin-mobile md:px-margin-desktop py-12">
        <!-- Welcome Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
            <div class="animate-fade-in-down">
                <h1 class="font-headline-xl text-headline-xl text-primary drop-shadow-[4px_4px_0px_#1b1c1c] mb-2">Halo,
                    {{ auth()->user()->name }}! ✨</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant">Senang melihatmu kembali di dunia penuh warna
                    kami!</p>
            </div>
            <div
                class="bg-primary-container comic-border p-4 comic-shadow sticker-rotate-right flex items-center gap-3 animate-float">
                <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">stars</span>
                <div>
                    <div class="font-label-bold text-on-primary-container uppercase">Sparkle Kamu</div>
                    <div class="font-headline-lg text-headline-lg text-on-primary-container">
                        {{ number_format($venusPoints ?? 0) }} Poin</div>
                </div>
            </div>
        </div>

        <!-- Notification Banner -->
        @if($activeOrders && $activeOrders->count() > 0)
            <div
                class="mb-12 bg-tertiary-container comic-border p-4 comic-shadow flex items-center gap-4 relative overflow-hidden animate-fade-in">
                <div class="absolute -right-4 -top-4 opacity-20">
                    <span class="material-symbols-outlined text-8xl">local_shipping</span>
                </div>
                <span class="material-symbols-outlined text-on-tertiary-container text-3xl">notifications_active</span>
                <p class="font-label-bold text-label-bold text-on-tertiary-container">
                    Pesanan #{{ $activeOrders->first()->order_number }} sedang {{ $activeOrders->first()->status }}! 🚚 — Tenang
                    saja, keajaiban sedang dalam perjalanan.
                </p>
            </div>
        @endif

        <!-- Quick Access Bento Grid -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter mb-section-gap">
            <a href="{{ route('cart.index') }}"
                class="bg-surface-container-lowest comic-border p-8 comic-shadow press-effect flex flex-col items-center text-center gap-4 sticker-rotate-left transition-transform hover:scale-105">
                <div class="w-16 h-16 bg-primary-container rounded-full flex items-center justify-center comic-border">
                    <span class="material-symbols-outlined text-4xl text-on-primary-container">shopping_basket</span>
                </div>
                <h3 class="font-headline-lg text-headline-lg text-on-surface">Keranjang</h3>
                <p class="font-body-md text-on-surface-variant">Lihat item impianmu</p>
            </a>
            <a href="#"
                class="bg-surface-container-lowest comic-border p-8 comic-shadow press-effect flex flex-col items-center text-center gap-4 sticker-rotate-right transition-transform hover:scale-105">
                <div class="w-16 h-16 bg-secondary-container rounded-full flex items-center justify-center comic-border">
                    <span class="material-symbols-outlined text-4xl text-on-secondary-container"
                        style="font-variation-settings: 'FILL' 1;">favorite</span>
                </div>
                <h3 class="font-headline-lg text-headline-lg text-on-surface">Wishlist</h3>
                <p class="font-body-md text-on-surface-variant">Barang favoritmu</p>
            </a>
            <a href="#"
                class="bg-surface-container-lowest comic-border p-8 comic-shadow press-effect flex flex-col items-center text-center gap-4 sticker-rotate-left transition-transform hover:scale-105">
                <div class="w-16 h-16 bg-tertiary-container rounded-full flex items-center justify-center comic-border">
                    <span class="material-symbols-outlined text-4xl text-on-tertiary-container">history</span>
                </div>
                <h3 class="font-headline-lg text-headline-lg text-on-surface">Riwayat</h3>
                <p class="font-body-md text-on-surface-variant">Koleksi lamamu</p>
            </a>
            <a href="{{ route('settings') }}"
                class="bg-surface-container-lowest comic-border p-8 comic-shadow press-effect flex flex-col items-center text-center gap-4 sticker-rotate-right transition-transform hover:scale-105">
                <div class="w-16 h-16 bg-surface-variant rounded-full flex items-center justify-center comic-border">
                    <span class="material-symbols-outlined text-4xl text-on-surface-variant">manage_accounts</span>
                </div>
                <h3 class="font-headline-lg text-headline-lg text-on-surface">Profil</h3>
                <p class="font-body-md text-on-surface-variant">Atur akun kamu</p>
            </a>
        </section>

        <!-- Product Recommendations -->
        <section class="animate-fade-in-up">
            <div class="flex items-center gap-4 mb-8">
                <h2 class="font-headline-xl text-headline-xl text-on-background">Spesial Untukmu</h2>
                <div class="h-1 flex-grow bg-on-background rounded-full opacity-10"></div>
                <span class="material-symbols-outlined text-primary text-4xl">celebration</span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-gutter">
                @forelse($products->take(4) as $product)
                    <div
                        class="bg-white comic-border p-4 comic-shadow flex flex-col group relative hover:-translate-y-2 transition-all">
                        <div
                            class="bg-secondary-container comic-border rounded-lg mb-4 overflow-hidden aspect-square flex items-center justify-center relative">
                            <img class="w-full h-full object-cover sticker-rotate-left group-hover:scale-110 transition-transform duration-300"
                                src="{{ $product->image ? asset('storage/' . $product->image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuBDl4yG_3txYZB6wYeWFyDQy0HmKAf6DAlvDFZuyi8JW7xB1CRZzlLc2ZhNHhZ8B0OFVeoi5dparUTMJE2FZppvRYJL9n-FlpygTsEn9GJhmdAqJMeqeFNIw-8cncrDCEv3czN8bhjUVxZIBt4OjI_c-KlPoVVrRM73PQ0st4rNZVG-THfWp_xaMKcwJQnQYam1_KI0irTUTuy1lyTjYSa5jWTiEa7DmB94HCCVotBJytO6PcSU04o0MEd7Oqunl_5D1Ohx0SmqB3rG' }}" />
                            @if($product->is_featured)
                                <div
                                    class="absolute top-2 right-2 bg-primary comic-border px-3 py-1 text-on-primary font-label-bold sticker-rotate-right">
                                    NEW!</div>
                            @endif
                        </div>
                        <h4 class="font-headline-lg text-headline-lg text-on-surface truncate">{{ $product->name }}</h4>
                        <p class="font-body-md text-on-surface-variant mb-4 line-clamp-1">{{ $product->description }}</p>
                        <div class="mt-auto flex justify-between items-center">
                            <span class="font-price-display text-price-display text-primary">Rp
                                {{ number_format($product->price / 1000, 0) }}rb</span>
                            <a href="{{ route('products.show', $product->id) }}"
                                class="bg-primary-container comic-border p-2 press-effect flex items-center justify-center">
                                <span class="material-symbols-outlined text-on-primary-container">shopping_cart</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full py-20 text-center bg-surface-container-low border-4 border-dashed border-on-background rounded-2xl">
                        <p class="font-headline-lg text-on-surface-variant italic text-3xl">Mulai belanja untuk melihat
                            rekomendasi! ✨</p>
                    </div>
                @endforelse
            </div>
        </section>
    </main>
@endsection