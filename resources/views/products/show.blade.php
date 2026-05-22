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
                <img id="main-product-img" class="w-full h-full object-cover rounded-md rotate-2 scale-90" alt="{{ $product->name ?? 'Product image' }}" src="{{ $product->image ? $product->image_url : 'https://placehold.co/400' }}" />
            </div>
            
            <div class="flex flex-wrap gap-4">
                @php
                $imgUrl = $product->image ? $product->image_url : 'https://placehold.co/400';
                $thumbs = $product->slide_urls;
                if (empty($thumbs)) {
                    $thumbs = [$imgUrl];
                }
                @endphp
                @foreach($thumbs as $index => $thumb)
                <div onclick="document.getElementById('main-product-img').src='{{ $thumb }}'; changeActiveThumb(this)" 
                    class="w-24 h-24 bg-surface-bright border-4 border-on-background rounded-lg p-2 comic-shadow-sm cursor-pointer hover:scale-105 transition-all {{ $index === 0 ? 'ring-4 ring-primary ring-offset-1' : '' }} thumb-item">
                    <img class="w-full h-full object-cover rounded-sm" src="{{ $thumb }}" alt="Thumbnail {{ $index + 1 }}"/>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Right: Product Info -->
        <div class="flex flex-col gap-6">
            <div>
                <h1 class="font-headline-xl text-headline-xl text-on-background mb-2">{{ $product->name ?? 'Kawaii Cat Ear Headphones' }}</h1>
                <div class="flex items-center gap-2">
                    @php
                        $avgRating = $product->reviews->avg('rating') ?? 5;
                        $reviewCount = $product->reviews->count();
                    @endphp
                    <div class="flex text-secondary-container">
                        @for($i=1; $i<=5; $i++)
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ $i <= round($avgRating) ? 1 : 0 }};">star</span>
                        @endfor
                    </div>
                    <span class="font-label-bold text-on-surface-variant">({{ $reviewCount }} Ulasan)</span>
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
                @if($product->variants && $product->variants->count() > 0)
                <div>
                    <h3 class="font-label-bold mb-3 uppercase tracking-wider">Varian Tersedia</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($product->variants as $variant)
                        <button type="button" class="px-4 py-2 border-4 border-on-background bg-surface-bright font-label-bold rounded-lg comic-shadow-sm press-effect text-sm flex items-center gap-2">
                            @if($variant->color_hex)
                            <span class="w-4 h-4 rounded-full border-2 border-on-background" style="background-color: {{ $variant->color_hex }};"></span>
                            @endif
                            {{ $variant->color ?? '' }} {{ $variant->size ? ' - ' . $variant->size : '' }}
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

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

    <!-- Customer Reviews Section -->
    <section class="mt-section-gap">
        <div class="flex justify-between items-end mb-8">
            <h2 class="font-headline-lg text-headline-lg flex items-center gap-3">
                Ulasan Pembeli 
                <span class="material-symbols-outlined text-tertiary scale-125">rate_review</span>
            </h2>
        </div>
        
        @if($product->reviews->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
            @foreach($product->reviews as $review)
            <div class="bg-surface-bright border-4 border-on-background rounded-lg p-6 comic-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-secondary-container border-2 border-on-background rounded-full flex items-center justify-center font-headline-lg text-primary overflow-hidden">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $review->user->name }}" alt="Avatar">
                        </div>
                        <div>
                            <p class="font-label-bold text-on-background">{{ $review->user->name }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $review->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="flex text-secondary-container">
                        @for($i=1; $i<=5; $i++)
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' {{ $i <= $review->rating ? 1 : 0 }};">star</span>
                        @endfor
                    </div>
                </div>
                <p class="font-body-md text-on-surface-variant mb-4">
                    {{ $review->comment }}
                </p>
                @if($review->image)
                <div class="w-24 h-24 bg-surface-variant border-2 border-on-background rounded-md overflow-hidden cursor-pointer hover:scale-105 transition-transform" onclick="window.open('{{ asset('storage/' . $review->image) }}', '_blank')">
                    <img src="{{ asset('storage/' . $review->image) }}" class="w-full h-full object-cover" alt="Review Photo">
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-surface-bright border-4 border-dashed border-on-background rounded-xl p-10 text-center">
            <span class="material-symbols-outlined text-6xl text-on-surface-variant opacity-50 mb-4" style="font-variation-settings: 'FILL' 1;">chat_bubble</span>
            <p class="font-headline-lg text-on-surface-variant italic">Belum ada ulasan untuk produk ini. Jadilah yang pertama! ✨</p>
        </div>
        @endif
    </section>

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
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform" src="{{ $r->image ? $r->image_url : 'https://placehold.co/400' }}" alt="{{ $r->name }}" />
                </div>
                <div class="font-label-bold text-on-background mb-1 truncate">{{ $r->name }}</div>
                <div class="font-price-display text-primary text-sm sm:text-base">Rp {{ number_format($r->price, 0, ',', '.') }}</div>
            </a>
            @endforeach
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
    function changeActiveThumb(element) {
        document.querySelectorAll('.thumb-item').forEach(item => {
            item.classList.remove('ring-4', 'ring-primary', 'ring-offset-1');
        });
        element.classList.add('ring-4', 'ring-primary', 'ring-offset-1');
    }
</script>
@endpush
