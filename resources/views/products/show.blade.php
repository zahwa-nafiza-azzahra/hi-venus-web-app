@extends('layouts.app')
@section('title', ($product->name ?? 'Detail Produk') . ' | Hi Venus')

@section('body_class', 'kawaii-bg')

@push('styles')
<style>
    .kawaii-bg {
        background-color: #fcf9f8 !important;
        background-image: radial-gradient(#ffd8eb 2px, transparent 2px) !important;
        background-size: 24px 24px !important;
    }
    .comic-shadow {
        box-shadow: 6px 6px 0px 0px #1b1c1c;
    }
    .comic-shadow-sm {
        box-shadow: 4px 4px 0px 0px #1b1c1c;
    }
    .comic-shadow-lg {
        box-shadow: 8px 8px 0px 0px #1b1c1c;
    }
    .press-effect:active {
        transform: translate(2px, 2px);
        box-shadow: 2px 2px 0px 0px #1b1c1c;
    }
</style>
@endpush

@section('content')
<main class="max-w-[1440px] mx-auto px-margin-desktop py-12">
    <!-- Breadcrumb -->
    <nav class="mb-8 flex items-center gap-2 font-label-bold text-primary">
        <a href="{{ route('home') }}" class="opacity-70 hover:opacity-100 transition-opacity">Home</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <a href="{{ route('products.index') }}" class="opacity-70 hover:opacity-100 transition-opacity">Shop</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="font-bold">{{ $product->name ?? 'Kawaii Cat Ear Headphones' }}</span>
    </nav>

    <!-- Product Hero -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter items-start">
        <!-- Left: Image Gallery -->
        <div class="space-y-gutter relative">
            <!-- Decorative Sticker -->
            <div class="absolute -top-6 -left-6 z-10 bg-secondary-container border-4 border-on-background px-6 py-2 rounded-full comic-shadow-sm -rotate-6 font-headline-lg text-primary">
                Populer!
            </div>
            <div class="bg-surface-bright border-4 border-on-background rounded-lg p-6 comic-shadow-lg aspect-square flex items-center justify-center overflow-hidden">
                <img id="main-product-img" class="w-full h-full object-cover rounded-md rotate-2 scale-90" alt="{{ $product->name ?? 'Product image' }}" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400' }}" />
            </div>
            
            <div class="flex gap-4">
                @php
                $imgUrl = $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400';
                $thumbs = [
                    $imgUrl,
                    $imgUrl
                ];
                @endphp
                @foreach($thumbs as $thumb)
                <div onclick="document.getElementById('main-product-img').src='{{ $thumb }}'" class="w-24 h-24 bg-surface-bright border-4 border-on-background rounded-lg p-2 comic-shadow-sm cursor-pointer hover:scale-105 transition-transform">
                    <img class="w-full h-full object-cover rounded-sm" src="{{ $thumb }}" alt="Thumbnail"/>
                </div>
                @endforeach
                <div class="w-24 h-24 bg-surface-bright border-4 border-on-background rounded-lg p-2 comic-shadow-sm cursor-pointer hover:scale-105 transition-transform opacity-60">
                    <div class="w-full h-full bg-surface-variant flex items-center justify-center rounded-sm">
                        <span class="material-symbols-outlined">videocam</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Product Info -->
        <div class="flex flex-col gap-6">
            <div>
                <h1 class="font-headline-xl text-headline-xl text-on-background mb-2">{{ $product->name ?? 'Kawaii Cat Ear Headphones' }}</h1>
                <div class="flex items-center gap-2">
                    <div class="flex text-secondary-container">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined">star_half</span>
                    </div>
                    <span class="font-label-bold text-on-surface-variant">(124 Ulasan)</span>
                </div>
            </div>

            <!-- Price Tag Burst -->
            <div class="relative w-fit">
                <div class="bg-secondary-container border-4 border-on-background px-8 py-4 comic-shadow-sm transform -rotate-2">
                    <span class="font-price-display text-price-display text-on-background">Rp {{ number_format($product->price ?? 299000, 0, ',', '.') }}</span>
                </div>
                <div class="absolute -right-4 -top-4 w-12 h-12 bg-tertiary-container border-4 border-on-background rounded-full flex items-center justify-center rotate-12 comic-shadow-sm">
                    <span class="material-symbols-outlined text-white">sell</span>
                </div>
            </div>

            <div class="p-6 bg-surface-container-low border-4 border-on-background rounded-lg space-y-6">
                <!-- Color Selection -->
                <div>
                    <h3 class="font-label-bold mb-3 uppercase tracking-wider">Pilih Warna</h3>
                    <div class="flex gap-4">
                        <button class="w-10 h-10 rounded-full border-4 border-on-background bg-primary comic-shadow-sm ring-4 ring-primary ring-offset-2"></button>
                        <button class="w-10 h-10 rounded-full border-4 border-on-background bg-tertiary-container comic-shadow-sm"></button>
                        <button class="w-10 h-10 rounded-full border-4 border-on-background bg-primary-fixed-dim comic-shadow-sm"></button>
                    </div>
                </div>

                <!-- Size Selection -->
                <div>
                    <h3 class="font-label-bold mb-3 uppercase tracking-wider">Tipe Koneksi</h3>
                    <div class="flex flex-wrap gap-3">
                        <button class="px-6 py-2 border-4 border-on-background bg-secondary-container font-label-bold rounded-lg comic-shadow-sm press-effect">Bluetooth 5.0</button>
                        <button class="px-6 py-2 border-4 border-on-background bg-surface-bright font-label-bold rounded-lg comic-shadow-sm press-effect">Wired Only</button>
                    </div>
                </div>

                <!-- Description Tabs -->
                <div>
                    <div class="flex border-b-4 border-on-background mb-4">
                        <button class="px-6 py-2 font-label-bold border-t-4 border-l-4 border-r-4 border-on-background bg-surface-bright -mb-1 rounded-t-lg">Detail Produk</button>
                        <button class="px-6 py-2 font-label-bold text-on-surface-variant">Spesifikasi</button>
                    </div>
                    <p class="font-body-md text-on-surface-variant leading-relaxed">
                        {{ $product->description ?? 'Nikmati kualitas suara yang imersif sambil tetap tampil menggemaskan! Headphone ini dilengkapi dengan lampu LED RGB pada bagian telinga kucing yang bisa berubah warna. Bantalan telinga yang super empuk memastikan kenyamanan maksimal untuk pemakaian lama.' }}
                    </p>
                </div>
            </div>

            <!-- CTA Actions -->
            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                @auth
                <form action="{{ route('cart.add', $product->id ?? 1) }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="w-full bg-primary text-on-primary font-headline-lg py-4 px-8 border-4 border-on-background rounded-lg comic-shadow press-effect flex items-center justify-center gap-3">
                        <span class="material-symbols-outlined">shopping_bag</span> Tambah ke Keranjang
                    </button>
                </form>
                <button class="bg-surface-bright text-on-background font-headline-lg py-4 px-8 border-4 border-on-background rounded-lg comic-shadow press-effect flex-shrink-0">
                    <span class="material-symbols-outlined">favorite</span>
                </button>
                @else
                <a href="{{ route('login') }}" class="flex-1 bg-primary text-on-primary font-headline-lg py-4 px-8 border-4 border-on-background rounded-lg comic-shadow press-effect flex items-center justify-center gap-3 no-underline">
                    <span class="material-symbols-outlined text-3xl">login</span> Login untuk Belanja
                </a>
                @endauth
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 text-label-bold text-on-surface-variant mt-2">
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-tertiary">local_shipping</span> Gratis Ongkir
                </div>
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-tertiary">verified_user</span> Garansi 1 Tahun
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <section class="mt-section-gap">
        <div class="flex justify-between items-end mb-8">
            <h2 class="font-headline-lg text-headline-lg flex items-center gap-3">
                Produk Terkait 
                <span class="material-symbols-outlined text-primary scale-125">Sparkle</span>
            </h2>
            <a class="font-label-bold text-primary underline decoration-4 underline-offset-4 hover:opacity-80" href="{{ route('products.index') }}">Lihat Semua</a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-gutter">
            @foreach($relatedProducts as $idx => $r)
            <a href="{{ route('products.show', $r->id) }}" class="bg-surface-bright border-4 border-on-background rounded-lg p-4 comic-shadow transition-transform group {{ $idx % 2 == 0 ? 'hover:rotate-1' : 'hover:-rotate-1' }} block text-decoration-none">
                <div class="aspect-square bg-surface-variant rounded-md mb-4 overflow-hidden border-2 border-on-background">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform" src="{{ $r->image ? asset('storage/' . $r->image) : 'https://placehold.co/400' }}" alt="{{ $r->name }}" />
                </div>
                <div class="font-label-bold text-on-background mb-1 truncate">{{ $r->name }}</div>
                <div class="font-price-display text-primary text-sm sm:text-base">Rp {{ number_format($r->price, 0, ',', '.') }}</div>
            </a>
            @endforeach
        </div>
    </section>
</main>
@endsection
