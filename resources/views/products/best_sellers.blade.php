@extends('layouts.app')

@section('title', 'Best Sellers - Hi Venus')

@section('content')
<div class="px-margin-mobile md:px-margin-desktop py-section-gap max-w-7xl mx-auto">
    {{-- Hero Section --}}
    <div class="relative bg-[#FFC0CB] border-4 border-on-background p-8 md:p-12 rounded-[40px] shadow-[8px_8px_0px_0px_#1b1c1c] text-center rotate-1 mb-16 overflow-hidden">
        {{-- Decorative Elements --}}
        <div class="absolute -top-6 -left-6 bg-[#FFFF00] text-on-background w-20 h-20 rounded-full border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] flex items-center justify-center -rotate-12 animate-[bounce_4s_infinite]">
            <span class="material-symbols-outlined text-4xl">workspace_premium</span>
        </div>
        <div class="absolute -bottom-8 -right-8 bg-[#87CEFA] text-on-background w-24 h-24 rounded-full border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] flex items-center justify-center rotate-12 animate-[pulse_3s_infinite]">
            <span class="material-symbols-outlined text-5xl">diamond</span>
        </div>
        
        <div class="relative z-10">
            <h1 class="text-display-lg md:text-display-xl font-headline-xl font-black text-on-background italic mb-4">
                Pilihan Favorit Bestie! 🌟
            </h1>
            <p class="text-body-lg font-bold text-on-background bg-white/90 inline-block px-6 py-3 rounded-xl border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] -rotate-1">
                Produk-produk paling laris yang wajib masuk koleksimu! 🔥
            </p>
        </div>
    </div>

    {{-- Products Grid --}}
    @if($products->isEmpty())
        <div class="text-center py-20 bg-surface-variant border-4 border-on-background rounded-[40px] shadow-[8px_8px_0px_0px_#1b1c1c]">
            <span class="material-symbols-outlined text-6xl text-primary animate-pulse mb-4">sentiment_dissatisfied</span>
            <h3 class="text-headline-md font-black italic">Belum ada data penjualan nih!</h3>
            <p class="text-body-md font-bold mt-2">Yuk jadi yang pertama order barang lucu di toko kami!</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
            @foreach($products as $index => $product)
                <div class="group relative bg-white border-4 border-on-background rounded-3xl shadow-[6px_6px_0px_0px_#1b1c1c] hover:shadow-[10px_10px_0px_0px_#1b1c1c] hover:-translate-y-2 transition-all flex flex-col h-full overflow-hidden {{ $index % 2 == 0 ? 'rotate-1 hover:rotate-0' : '-rotate-1 hover:rotate-0' }}">
                    
                    {{-- Badge Spesial --}}
                    @if($index == 0)
                        <div class="absolute top-4 left-4 z-10 bg-[#FFD700] text-on-background font-black italic px-3 py-1 rounded-full border-2 border-on-background shadow-[2px_2px_0px_0px_#1b1c1c] -rotate-6">
                            👑 Top #1
                        </div>
                    @elseif($index == 1)
                        <div class="absolute top-4 left-4 z-10 bg-[#C0C0C0] text-on-background font-black italic px-3 py-1 rounded-full border-2 border-on-background shadow-[2px_2px_0px_0px_#1b1c1c] -rotate-6">
                            🥈 Top #2
                        </div>
                    @elseif($index == 2)
                        <div class="absolute top-4 left-4 z-10 bg-[#cd7f32] text-white font-black italic px-3 py-1 rounded-full border-2 border-on-background shadow-[2px_2px_0px_0px_#1b1c1c] -rotate-6">
                            🥉 Top #3
                        </div>
                    @else
                        <div class="absolute top-4 left-4 z-10 bg-[#FF69B4] text-white font-black italic px-3 py-1 rounded-full border-2 border-on-background shadow-[2px_2px_0px_0px_#1b1c1c] -rotate-6">
                            🔥 Laris!
                        </div>
                    @endif

                    <a href="{{ route('products.show', $product->id) }}" class="block aspect-square overflow-hidden border-b-4 border-on-background relative">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-surface-variant flex items-center justify-center">
                                <span class="material-symbols-outlined text-6xl text-on-surface-variant/50">shopping_bag</span>
                            </div>
                        @endif
                        
                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="bg-white text-on-background font-black italic px-6 py-3 rounded-full border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] rotate-3 group-hover:scale-110 transition-transform">
                                Lihat Detail 👀
                            </span>
                        </div>
                    </a>

                    <div class="p-5 flex flex-col flex-grow bg-white">
                        <div class="flex justify-between items-start gap-2 mb-2">
                            <a href="{{ route('products.show', $product->id) }}" class="font-headline-sm font-black italic text-on-background hover:text-primary transition-colors line-clamp-2">
                                {{ $product->name }}
                            </a>
                            @auth
                            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="flex-shrink-0">
                                @csrf
                                @php
                                    $inWishlist = \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists();
                                @endphp
                                <button type="submit" class="hover:scale-110 transition-transform flex">
                                    <span class="material-symbols-outlined {{ $inWishlist ? 'text-[#FF1493]' : 'text-on-background/50' }}" style="font-variation-settings: 'FILL' {{ $inWishlist ? '1' : '0' }}; text-shadow: 1px 1px 0px #1b1c1c;">favorite</span>
                                </button>
                            </form>
                            @endauth
                        </div>
                        <div class="font-body-sm font-bold text-on-background/70 mb-4">{{ $product->category->name }}</div>
                        
                        <div class="mt-auto flex justify-between items-end">
                            <div class="font-headline-md font-black text-[#9e357b]">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                            <div class="text-xs font-bold bg-[#F0FFF0] text-[#32CD32] px-2 py-1 rounded-lg border-2 border-on-background">
                                Terjual: {{ $product->total_sold ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
