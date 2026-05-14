@extends('layouts.app')

@section('title', 'Shop - Hi Venus')

@section('body_class', 'grid-kawaii-pattern')

@push('styles')
<style>
    .grid-kawaii-pattern {
        background-color: #ffffff !important;
        background-image: 
            linear-gradient(#ff85d0 2px, transparent 2px),
            linear-gradient(90deg, #a7f3d0 2px, transparent 2px) !important;
        background-size: 60px 60px !important;
        background-attachment: fixed !important;
    }
    body {
        background-color: #ffffff !important;
    }
</style>
@endpush

@section('content')
<main class="flex-grow flex flex-col md:flex-row gap-gutter p-margin-mobile md:p-margin-desktop max-w-[1600px] mx-auto w-full">
    <!-- Left Sidebar (Filters) -->
    <aside class="w-full md:w-80 flex-shrink-0 flex flex-col gap-8 relative z-10 animate-fade-in-left">
        <!-- Decorative Sticker -->
        <div class="absolute -top-6 -left-6 bg-secondary-fixed text-on-secondary-fixed font-headline-lg text-headline-lg border-4 border-on-background p-2 rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] rotate-[-15deg] z-20 animate-float">
            <span class="material-symbols-outlined text-4xl">favorite</span>
        </div>
        <!-- Categories Card -->
        <div class="bg-surface-bright border-4 border-on-background rounded-xl p-6 shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] flex flex-col gap-4">
            <h2 class="font-headline-lg text-headline-lg text-on-background border-b-4 border-on-background pb-2 mb-2 italic">Categories</h2>
            @foreach($categories as $category)
            <label class="flex items-center gap-4 cursor-pointer group">
                <div class="w-8 h-8 flex-shrink-0 border-4 border-on-background {{ request('category') == $category->slug ? 'bg-primary-container' : 'bg-surface-variant' }} flex items-center justify-center group-hover:bg-primary-container transition-colors shadow-[2px_2px_0px_0px_rgba(27,28,28,1)]">
                    <span class="material-symbols-outlined {{ request('category') == $category->slug ? 'opacity-100' : 'opacity-0' }} text-on-background text-xl" style="font-variation-settings: 'wght' 900;">close</span>
                </div>
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="font-label-bold text-label-bold text-body-lg {{ request('category') == $category->slug ? 'text-primary' : 'group-hover:text-primary' }} transition-colors">{{ $category->name }}</a>
            </label>
            @endforeach
        </div>
    </aside>

    <!-- Product Grid Area -->
    <div class="flex-grow flex flex-col gap-8 animate-fade-in-right">
        <!-- Grid Header -->
        <div class="flex flex-col sm:flex-row justify-between items-center bg-surface-bright border-4 border-on-background p-4 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] relative z-10">
            <p class="font-body-lg text-body-lg">Showing <span class="font-bold text-primary">1-8</span> of 42 super cute items!</p>
            <div class="flex items-center gap-4 mt-4 sm:mt-0">
                <span class="font-label-bold text-label-bold">Sort by:</span>
                <select class="appearance-none bg-primary-container border-4 border-on-background rounded-lg px-4 py-2 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] focus:outline-none focus:border-tertiary cursor-pointer pr-10">
                    <option>Most Popular</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Newest Arrivals</option>
                </select>
            </div>
        </div>
        
        <!-- The Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-gutter z-10 stagger-container">
            @forelse($products as $idx => $p)
            <div class="bg-surface-bright border-4 border-on-background p-4 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] relative flex flex-col items-center group hover:-translate-y-2 transition-transform duration-300">
                <div class="absolute -top-4 -right-4 bg-secondary-container text-on-secondary-container border-4 border-on-background rounded-full font-price-display text-price-display px-4 py-2 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] {{ $idx % 2 == 0 ? 'rotate-12' : '-rotate-6' }} z-20 group-hover:scale-110 transition-transform">
                    Rp {{ number_format($p->price / 1000, 0) }}k
                </div>
                
                @if($p->is_new)
                <div class="absolute -top-4 -left-4 bg-tertiary-fixed text-on-background border-4 border-on-background rounded-full font-label-bold text-label-bold px-3 py-1 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] -rotate-12 z-20 animate-pulse">
                    NEW!
                </div>
                @elseif($p->is_featured)
                <div class="absolute -top-4 -left-4 bg-error text-on-error border-4 border-on-background rounded-full font-label-bold text-label-bold px-3 py-1 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] rotate-12 z-20 animate-bounce">
                    HOT!
                </div>
                @endif
                
                <div class="bg-surface-variant border-4 border-on-background rounded-lg overflow-hidden w-full aspect-square mb-4 group-hover:{{ $idx % 2 == 0 ? '-rotate-2' : 'rotate-2' }} transition-transform cursor-pointer">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ $p->image ? asset('storage/' . $p->image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5RyDys8VL3YqIOOgeEDYk8hRy2QwYwoMZOCjbxjiBe-XbfoJApDPdRc8KnsjAe3M5zLSH1i9ZxKQLjUH-SjykjKvex6zuVYPbSdGtEXLPJDEFQixIGhRViepgCEXlcCX9WY0oGKhSAw7uUighIIPrD7dTQKHJjeu7x53gQ00abxTWUZQmKEs2F9gNY6OW-i8qCzwOQG4GX_4xsyCrEh3dOmohjniqxHNHMUmNQFchd_DkjCPsN921gcBpmcIZ21sAo6PgpfujKuIf' }}" alt="{{ $p->name }}"/>
                </div>
                <h3 class="font-body-lg text-body-lg font-bold text-center leading-tight min-h-[3rem] flex items-center">{{ $p->name }}</h3>
                <form action="{{ route('cart.add', $p->id) }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full bg-primary text-on-primary border-4 border-on-background rounded-lg py-3 mt-4 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all flex justify-center items-center gap-2">
                        <span class="material-symbols-outlined">add_shopping_cart</span> Add to Cart
                    </button>
                </form>
            </div>
            @empty
            <div class="col-span-full py-20 text-center bg-white border-4 border-dashed border-on-background rounded-2xl">
                <p class="font-headline-lg text-on-surface-variant italic text-3xl">Belum ada produk untuk ditampilkan! ✨</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="flex justify-center items-center gap-4 mt-section-gap z-10 pb-8">
            <button class="w-12 h-12 flex items-center justify-center bg-surface-bright text-on-surface border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="w-12 h-12 flex items-center justify-center bg-primary text-on-primary border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                1
            </button>
            <button class="w-12 h-12 flex items-center justify-center bg-surface-bright text-on-surface border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                2
            </button>
            <button class="w-12 h-12 flex items-center justify-center bg-surface-bright text-on-surface border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                3
            </button>
            <span class="font-headline-lg text-headline-lg mx-2 tracking-widest text-primary">...</span>
            <button class="w-12 h-12 flex items-center justify-center bg-surface-bright text-on-surface border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                6
            </button>
            <button class="w-12 h-12 flex items-center justify-center bg-surface-bright text-on-surface border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </div>
    </div>
</main>
@endsection
