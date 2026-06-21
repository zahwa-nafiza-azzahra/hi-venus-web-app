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
<main class="flex-grow flex flex-col gap-gutter p-margin-mobile md:p-margin-desktop max-w-[1600px] mx-auto w-full">
    <!-- Product Grid Area -->
    <div class="flex-grow flex flex-col gap-8 animate-fade-in">
        <!-- Grid Header -->
        <div class="flex flex-col md:flex-row justify-between items-center bg-surface-bright border-4 border-on-background p-4 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] relative z-10 gap-4">
            <p class="font-body-lg text-body-lg text-center md:text-left">Showing <span class="font-bold text-primary">{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</span> of <span class="font-bold text-primary">{{ $products->total() }}</span> items!</p>
            <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <span class="font-label-bold text-label-bold whitespace-nowrap">Category:</span>
                    <select onchange="window.location.href=this.value" class="w-full sm:w-auto appearance-none bg-primary-container border-4 border-on-background rounded-lg px-4 py-2 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] focus:outline-none focus:border-tertiary cursor-pointer pr-8 bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%3E%3Cpath%20d%3D%22M7%2010l5%205%205-5z%22%2F%3E%3C%2Fsvg%3E')] bg-no-repeat bg-[position:calc(100%-0.5rem)_center] bg-[length:1.5rem_1.5rem]">
                        <option value="{{ route('products.index') }}">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ route('products.index', ['category' => $category->slug]) }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <span class="font-label-bold text-label-bold whitespace-nowrap">Sort by:</span>
                    <select class="w-full sm:w-auto appearance-none bg-primary-container border-4 border-on-background rounded-lg px-4 py-2 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] focus:outline-none focus:border-tertiary cursor-pointer pr-8 bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%3E%3Cpath%20d%3D%22M7%2010l5%205%205-5z%22%2F%3E%3C%2Fsvg%3E')] bg-no-repeat bg-[position:calc(100%-0.5rem)_center] bg-[length:1.5rem_1.5rem]">
                        <option>Most Popular</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Newest Arrivals</option>
                    </select>
                </div>
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
                
                <a href="{{ route('products.show', $p->id) }}" class="block w-full">
                    <div class="bg-surface-variant border-4 border-on-background rounded-lg overflow-hidden w-full aspect-square mb-4 group-hover:{{ $idx % 2 == 0 ? '-rotate-2' : 'rotate-2' }} transition-transform cursor-pointer">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ $p->image ? $p->image_url : 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5RyDys8VL3YqIOOgeEDYk8hRy2QwYwoMZOCjbxjiBe-XbfoJApDPdRc8KnsjAe3M5zLSH1i9ZxKQLjUH-SjykjKvex6zuVYPbSdGtEXLPJDEFQixIGhRViepgCEXlcCX9WY0oGKhSAw7uUighIIPrD7dTQKHJjeu7x53gQ00abxTWUZQmKEs2F9gNY6OW-i8qCzwOQG4GX_4xsyCrEh3dOmohjniqxHNHMUmNQFchd_DkjCPsN921gcBpmcIZ21sAo6PgpfujKuIf' }}" alt="{{ $p->name }}"/>
                    </div>
                    <h3 class="font-body-lg text-body-lg font-bold text-center leading-tight min-h-[3rem] flex justify-center items-center text-on-background">{{ $p->name }}</h3>
                </a>
                @auth
                <div class="flex gap-2 w-full mt-4">
                    <a href="{{ route('products.show', $p->id) }}" class="bg-secondary-container text-on-secondary-container border-4 border-on-background rounded-lg px-4 py-3 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all flex justify-center items-center">
                        <span class="material-symbols-outlined">visibility</span>
                    </a>
                    <form action="{{ route('wishlist.toggle', $p->id) }}" method="POST" class="flex-none">
                        @csrf
                        @php
                            $inWishlist = \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $p->id)->exists();
                        @endphp
                        <button type="submit" class="bg-surface-bright text-on-background border-4 border-on-background rounded-lg px-4 py-3 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all flex justify-center items-center">
                            <span class="material-symbols-outlined {{ $inWishlist ? 'text-primary' : '' }}" style="font-variation-settings: 'FILL' {{ $inWishlist ? '1' : '0' }};">favorite</span>
                        </button>
                    </form>
                    <form action="{{ route('cart.add', $p->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-primary text-on-primary border-4 border-on-background rounded-lg py-3 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all flex justify-center items-center gap-1">
                            <span class="material-symbols-outlined">add_shopping_cart</span> Cart
                        </button>
                    </form>
                </div>
                @else
                <a href="{{ route('products.show', $p->id) }}" class="w-full bg-secondary-container text-on-secondary-container border-4 border-on-background rounded-lg py-3 mt-4 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all flex justify-center items-center gap-2">
                    <span class="material-symbols-outlined">visibility</span> See Detail Product
                </a>
                @endauth
            </div>
            @empty
            <div class="col-span-full py-20 text-center bg-white border-4 border-dashed border-on-background rounded-2xl">
                <p class="font-headline-lg text-on-surface-variant italic text-3xl">Belum ada produk untuk ditampilkan! ✨</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if ($products->hasPages())
        <div class="flex justify-center items-center gap-4 mt-section-gap z-10 pb-8">
            {{-- Previous Page Link --}}
            @if ($products->onFirstPage())
                <span class="w-12 h-12 flex items-center justify-center bg-surface-bright text-on-surface-variant border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] opacity-50 cursor-not-allowed">
                    <span class="material-symbols-outlined">chevron_left</span>
                </span>
            @else
                <a href="{{ $products->previousPageUrl() }}" class="w-12 h-12 flex items-center justify-center bg-surface-bright text-on-surface border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                    <span class="material-symbols-outlined">chevron_left</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @php
                $start = max($products->currentPage() - 1, 1);
                $end = min($products->currentPage() + 1, $products->lastPage());
            @endphp
            
            @if($start > 1)
                <a href="{{ $products->url(1) }}" class="w-12 h-12 flex items-center justify-center bg-surface-bright text-on-surface border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">1</a>
                @if($start > 2)
                    <span class="font-headline-lg text-headline-lg mx-2 tracking-widest text-primary">...</span>
                @endif
            @endif

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $products->currentPage())
                    <span class="w-12 h-12 flex items-center justify-center bg-primary text-on-primary border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                        {{ $i }}
                    </span>
                @else
                    <a href="{{ $products->url($i) }}" class="w-12 h-12 flex items-center justify-center bg-surface-bright text-on-surface border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                        {{ $i }}
                    </a>
                @endif
            @endfor

            @if($end < $products->lastPage())
                @if($end < $products->lastPage() - 1)
                    <span class="font-headline-lg text-headline-lg mx-2 tracking-widest text-primary">...</span>
                @endif
                <a href="{{ $products->url($products->lastPage()) }}" class="w-12 h-12 flex items-center justify-center bg-surface-bright text-on-surface border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold text-label-bold hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">{{ $products->lastPage() }}</a>
            @endif

            {{-- Next Page Link --}}
            @if ($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" class="w-12 h-12 flex items-center justify-center bg-surface-bright text-on-surface border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                    <span class="material-symbols-outlined">chevron_right</span>
                </a>
            @else
                <span class="w-12 h-12 flex items-center justify-center bg-surface-bright text-on-surface-variant border-4 border-on-background rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] opacity-50 cursor-not-allowed">
                    <span class="material-symbols-outlined">chevron_right</span>
                </span>
            @endif
        </div>
        @endif
    </div>
</main>
@endsection
