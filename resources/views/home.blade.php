@extends('layouts.app')

@section('title', 'Hi Venus | Kawaii Boutique')

@section('body_class', 'grid-kawaii-pattern')

@push('styles')
<style>
    .grid-kawaii-pattern {
        background-color: #d0f0ff !important; /* Soft sky blue */
        background-image: 
            radial-gradient(#ff97cf 18%, transparent 18%),
            radial-gradient(#ffde59 18%, transparent 18%) !important;
        background-size: 80px 80px !important;
        background-position: 0 0, 40px 40px !important;
        background-attachment: fixed !important;
    }
    body {
        background-color: #ffffff !important;
    }
</style>
@endpush

@section('content')
<div class="pb-section-gap">
    <!-- Hero Section -->
    <section class="mx-margin-mobile md:mx-margin-desktop mt-8 mb-section-gap border-4 border-on-background rounded-xl bg-surface-bright overflow-hidden shadow-[8px_8px_0px_0px_#1b1c1c] flex flex-col md:flex-row relative animate-scale-in">
        <div class="p-8 md:p-12 md:w-1/2 z-10 flex flex-col justify-center gap-6 animate-fade-in-left delay-200 fill-backwards">
            <h1 class="text-headline-lg-mobile md:text-headline-xl font-headline-xl text-primary font-black uppercase leading-tight">
                Hi there, cutie! ✨<br/>Discover adorable outfits
            </h1>
            <p class="text-body-lg font-body-lg text-on-surface-variant">
                Step into our vibrant kawaii boutique and find your next favorite statement piece. Unapologetically fun, colorful, and perfectly you!
            </p>
            <a href="{{ route('products.index') }}" class="mt-4 border-4 border-on-background bg-secondary-container text-on-secondary-container font-label-bold text-label-bold px-8 py-4 rounded-full shadow-[4px_4px_0px_0px_#1b1c1c] hover:translate-y-0.5 hover:translate-x-0.5 hover:shadow-[2px_2px_0px_0px_#1b1c1c] active:translate-y-1 active:translate-x-1 active:shadow-none transition-all w-max inline-flex items-center gap-2">
                <span class="material-symbols-outlined">storefront</span>
                Shop Now
            </a>
        </div>
        <div class="md:w-1/2 relative min-h-[300px] md:min-h-[500px] bg-primary flex items-center justify-center p-8 border-t-4 md:border-t-0 md:border-l-4 border-on-background bg-[radial-gradient(#ffaedb_4px,transparent_4px)] [background-size:24px_24px] animate-fade-in-right delay-200 fill-backwards">
            <!-- Decorative Elements -->
            <div class="absolute top-4 left-4 text-secondary-container rotate-12 animate-float">
                <span class="material-symbols-outlined text-6xl" style="font-variation-settings: 'FILL' 1;">star</span>
            </div>
            <div class="absolute bottom-8 right-8 text-tertiary-container -rotate-12 animate-float [animation-delay:1.5s]">
                <span class="material-symbols-outlined text-5xl" style="font-variation-settings: 'FILL' 1;">favorite</span>
            </div>
            <!-- Main Hero Graphic Container -->
            <div class="relative w-full h-full max-w-md bg-surface-bright border-4 border-on-background shadow-[8px_8px_0px_0px_#1b1c1c] rounded-2xl overflow-hidden rotate-2 hover:rotate-0 transition-transform duration-500 cursor-pointer group">
                <img alt="Kawaii fashion display" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxvZxl1niFOXOV1h0pOODzZJ-DxUEpM___ALpRwRTpEYFztuyIkJokaaP0Zalm9tbzJyKBhY8BmQQJ8-00mcRWwyhFCYPhE0_wiot5iS_Z6x6t3u-F_V_nqya5wBEQIbKP5RbGERc4XQjqCtCNyjB6JCIZRIoSqjsLYSkqjvPI46ODhs0zlIlOuGNNPjbWtC1j_MkffR4k36UBHzlSIhxvrFcTc8oXHSA9eWlq4RKi8pQ334R7XxmNBA8CmKsn23qZKDKpQkxXxKEO"/>
            </div>
        </div>
    </section>

    <!-- Shop by Category -->
    <section class="mx-margin-mobile md:mx-margin-desktop mb-section-gap" data-animate>
        <div class="flex items-center gap-4 mb-8">
            <h2 class="text-headline-lg font-headline-lg text-on-background font-black bg-surface-bright border-4 border-on-background px-6 py-2 rounded-full shadow-[4px_4px_0px_0px_#1b1c1c]">Shop by Category</h2>
            <span class="material-symbols-outlined text-primary text-4xl rotate-12 bg-surface-bright border-4 border-on-background rounded-full p-2 shadow-[4px_4px_0px_0px_#1b1c1c] animate-spin [animation-duration:10s]" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
        </div>
        <div class="flex flex-wrap gap-8 justify-center md:justify-start stagger-container">
            <!-- Category 1 -->
            <a class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-on-background bg-tertiary-fixed flex flex-col items-center justify-center gap-2 shadow-[4px_4px_0px_0px_#1b1c1c] hover:-translate-y-2 hover:-translate-x-1 transition-transform hover:shadow-[6px_6px_0px_0px_#1b1c1c] active:translate-y-1 active:translate-x-1 active:shadow-none group" href="#">
                <span class="material-symbols-outlined text-4xl text-on-tertiary-fixed group-hover:scale-110 transition-transform">checkroom</span>
                <span class="font-label-bold text-label-bold text-on-tertiary-fixed uppercase">Dresses</span>
            </a>
            <!-- Category 2 -->
            <a class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-on-background bg-primary-fixed flex flex-col items-center justify-center gap-2 shadow-[4px_4px_0px_0px_#1b1c1c] hover:-translate-y-2 hover:-translate-x-1 transition-transform hover:shadow-[6px_6px_0px_0px_#1b1c1c] active:translate-y-1 active:translate-x-1 active:shadow-none group" href="#">
                <span class="material-symbols-outlined text-4xl text-on-primary-fixed group-hover:scale-110 transition-transform">apparel</span>
                <span class="font-label-bold text-label-bold text-on-primary-fixed uppercase">Tops</span>
            </a>
            <!-- Category 3 -->
            <a class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-on-background bg-secondary-fixed flex flex-col items-center justify-center gap-2 shadow-[4px_4px_0px_0px_#1b1c1c] hover:-translate-y-2 hover:-translate-x-1 transition-transform hover:shadow-[6px_6px_0px_0px_#1b1c1c] active:translate-y-1 active:translate-x-1 active:shadow-none group" href="#">
                <span class="material-symbols-outlined text-4xl text-on-secondary-fixed group-hover:scale-110 transition-transform">styler</span>
                <span class="font-label-bold text-label-bold text-on-secondary-fixed uppercase">Bottoms</span>
            </a>
            <!-- Category 4 -->
            <a class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-on-background bg-surface-bright flex flex-col items-center justify-center gap-2 shadow-[4px_4px_0px_0px_#1b1c1c] hover:-translate-y-2 hover:-translate-x-1 transition-transform hover:shadow-[6px_6px_0px_0px_#1b1c1c] active:translate-y-1 active:translate-x-1 active:shadow-none group" href="#">
                <span class="material-symbols-outlined text-4xl text-on-surface-variant group-hover:scale-110 transition-transform">diamond</span>
                <span class="font-label-bold text-label-bold text-on-surface-variant uppercase">Accessories</span>
            </a>
        </div>
    </section>

    <!-- Trending Now -->
    <section class="mx-margin-mobile md:mx-margin-desktop" data-animate>
        <div class="flex items-center gap-4 mb-8">
            <h2 class="text-headline-lg font-headline-lg text-on-background font-black bg-surface-bright border-4 border-on-background px-6 py-2 rounded-full shadow-[4px_4px_0px_0px_#1b1c1c]">Trending Now</h2>
            <span class="material-symbols-outlined text-secondary-container text-4xl -rotate-12 bg-surface-bright border-4 border-on-background rounded-full p-2 shadow-[4px_4px_0px_0px_#1b1c1c] animate-bounce" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
            @forelse($products as $product)
            <!-- Product Card -->
            <div class="bg-surface-bright border-4 border-on-background rounded-xl p-4 shadow-[6px_6px_0px_0px_#1b1c1c] relative group hover:-translate-y-2 transition-transform duration-200 flex flex-col">
                @if($product->is_new)
                <div class="absolute -left-4 top-8 bg-tertiary-container text-on-tertiary-container font-label-bold text-label-bold px-3 py-1 border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] -rotate-12 z-20 uppercase tracking-wider animate-pulse">
                    New!
                </div>
                @endif
                <div class="aspect-square bg-tertiary-fixed-dim rounded-lg mb-4 overflow-hidden border-4 border-on-background flex items-center justify-center relative p-4 bg-[radial-gradient(#c1e8ff_2px,transparent_2px)] [background-size:16px_16px]">
                    <img alt="{{ $product->name }}" class="w-full h-full object-contain transform rotate-3 group-hover:scale-105 transition-transform duration-300 drop-shadow-[4px_4px_0px_rgba(27,28,28,0.5)]" src="{{ $product->image ? asset('storage/' . $product->image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5RyDys8VL3YqIOOgeEDYk8hRy2QwYwoMZOCjbxjiBe-XbfoJApDPdRc8KnsjAe3M5zLSH1i9ZxKQLjUH-SjykjKvex6zuVYPbSdGtEXLPJDEFQixIGhRViepgCEXlcCX9WY0oGKhSAw7uUighIIPrD7dTQKHJjeu7x53gQ00abxTWUZQmKEs2F9gNY6OW-i8qCzwOQG4GX_4xsyCrEh3dOmohjniqxHNHMUmNQFchd_DkjCPsN921gcBpmcIZ21sAo6PgpfujKuIf' }}"/>
                    <!-- Price Badge -->
                    <div class="absolute -top-3 -right-3 bg-primary text-on-primary font-price-display text-price-display px-4 py-2 rounded-full border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] rotate-12 z-10 group-hover:scale-110 transition-transform">
                        Rp {{ number_format($product->price / 1000, 0) }}k
                    </div>
                </div>
                <div class="flex justify-between items-start mt-auto">
                    <div>
                        <h3 class="text-body-lg font-body-lg text-on-background font-bold line-clamp-2">{{ $product->name }}</h3>
                        <p class="text-body-md font-body-md text-on-surface-variant mt-1">{{ Str::limit($product->description, 50) }}</p>
                    </div>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="ml-4 shrink-0 bg-secondary-container text-on-secondary-container border-4 border-on-background rounded-full p-2 shadow-[2px_2px_0px_0px_#1b1c1c] hover:bg-secondary-fixed active:translate-y-1 active:translate-x-1 active:shadow-none transition-all">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add</span>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center bg-white border-4 border-dashed border-on-background rounded-2xl">
                <p class="font-headline-lg text-on-surface-variant italic">Koleksi baru akan segera hadir! ✨</p>
            </div>
            @endforelse
        </div>
    </section>
</div>
@endsection
