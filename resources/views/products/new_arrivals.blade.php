@extends('layouts.app')

@section('title', 'New Arrivals - Hi Venus')

@section('content')
<div class="px-margin-mobile md:px-margin-desktop py-section-gap max-w-7xl mx-auto">
    {{-- Hero Section --}}
    <div class="relative bg-[#E6E6FA] border-4 border-on-background p-8 md:p-12 rounded-[40px] shadow-[8px_8px_0px_0px_#1b1c1c] text-center -rotate-1 mb-16 overflow-hidden">
        {{-- Decorative Elements --}}
        <div class="absolute -top-6 -right-6 bg-[#98FF98] text-on-background w-24 h-24 rounded-full border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] flex items-center justify-center rotate-12 animate-[bounce_3s_infinite]">
            <span class="material-symbols-outlined text-5xl">new_releases</span>
        </div>
        <div class="absolute -bottom-8 -left-8 bg-[#FF69B4] text-white w-20 h-20 rounded-full border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] flex items-center justify-center -rotate-12 animate-[pulse_2s_infinite]">
            <span class="material-symbols-outlined text-4xl">favorite</span>
        </div>
        
        <div class="relative z-10">
            <h1 class="text-display-lg md:text-display-xl font-headline-xl font-black text-on-background italic mb-4">
                Fresh from the Oven! 🍞✨
            </h1>
            <p class="text-body-lg font-bold text-on-background bg-white/90 inline-block px-6 py-3 rounded-xl border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] rotate-1">
                Koleksi paling baru yang siap bikin gayamu makin gemas maksimal!
            </p>
        </div>
    </div>

    {{-- Products Grid --}}
    @if($products->isEmpty())
        <div class="text-center py-20 bg-surface-variant border-4 border-on-background rounded-[40px] shadow-[8px_8px_0px_0px_#1b1c1c] rotate-1">
            <span class="material-symbols-outlined text-6xl text-primary animate-pulse mb-4">inventory_2</span>
            <h3 class="text-headline-md font-black italic">Oops, belum ada barang baru nih!</h3>
            <p class="text-body-md font-bold mt-2">Mimin Venus lagi siap-siap restock barang lucu. Tungguin ya!</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
            @foreach($products as $index => $product)
                <div class="group relative bg-white border-4 border-on-background rounded-3xl shadow-[6px_6px_0px_0px_#1b1c1c] hover:shadow-[10px_10px_0px_0px_#1b1c1c] hover:-translate-y-2 transition-all flex flex-col h-full overflow-hidden {{ $index % 2 == 0 ? '-rotate-1 hover:rotate-0' : 'rotate-1 hover:rotate-0' }}">
                    
                    {{-- Badge Spesial --}}
                    <div class="absolute top-4 right-4 z-10 bg-[#00CED1] text-white font-black italic px-4 py-1 rounded-full border-2 border-on-background shadow-[2px_2px_0px_0px_#1b1c1c] rotate-6 animate-[pulse_3s_infinite]">
                        ✨ NEW!
                    </div>

                    <a href="{{ route('products.show', $product->id) }}" class="block aspect-square overflow-hidden border-b-4 border-on-background relative">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-surface-variant flex items-center justify-center">
                                <span class="material-symbols-outlined text-6xl text-on-surface-variant/50">shopping_bag</span>
                            </div>
                        @endif
                        
                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-[#E6E6FA]/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="bg-white text-on-background font-black italic px-6 py-3 rounded-full border-4 border-on-background shadow-[4px_4px_0px_0px_#1b1c1c] -rotate-3 group-hover:scale-110 transition-transform">
                                Intip Yuk! 👀
                            </span>
                        </div>
                    </a>

                    <div class="p-5 flex flex-col flex-grow bg-white">
                        <div class="flex justify-between items-start gap-2 mb-2">
                            <a href="{{ route('products.show', $product->id) }}" class="font-headline-sm font-black italic text-on-background hover:text-[#9e357b] transition-colors line-clamp-2">
                                {{ $product->name }}
                            </a>
                        </div>
                        <div class="font-body-sm font-bold text-on-background/70 mb-4">{{ $product->category->name }}</div>
                        
                        <div class="mt-auto">
                            <div class="font-headline-md font-black text-[#FF1493]">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
