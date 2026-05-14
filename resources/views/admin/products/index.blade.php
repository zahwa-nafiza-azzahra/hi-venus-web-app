@extends('layouts.admin')

@section('title', 'Products Inventory | Hi Venus')

@push('styles')
<style>
    .comic-shadow {
        box-shadow: 4px 4px 0px 0px #1b1c1c;
    }
    .comic-shadow-lg {
        box-shadow: 8px 8px 0px 0px #1b1c1c;
    }
    .comic-border {
        border: 3px solid #1b1c1c;
    }
    .comic-border-thick {
        border: 4px solid #1b1c1c;
    }
    .comic-button-hover:hover {
        transform: translate(2px, 2px);
        box-shadow: 2px 2px 0px 0px #1b1c1c;
    }
    .sticker-rotate {
        transform: rotate(-2deg);
    }
    .sticker-rotate-reverse {
        transform: rotate(3deg);
    }
    .bg-pattern {
        background-image: radial-gradient(#d8c0cb 2px, transparent 2px);
        background-size: 20px 20px;
    }
</style>
@endpush

@section('content')
<div class="animate-fade-in">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-6 relative">
        <!-- Decorative Sparkle -->
        <div class="absolute -top-4 -left-4 text-tertiary-container sticker-rotate">
            <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">flare</span>
        </div>
        <div>
            <h2 class="font-headline-lg text-headline-lg md:font-headline-xl md:text-headline-xl text-on-surface mb-2 relative z-10 inline-block">
                Products Inventory
                <span class="absolute -bottom-2 left-0 w-full h-4 bg-secondary-container -z-10 rounded-full opacity-60"></span>
            </h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant">Manage your kawaii collection here!</p>
        </div>
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="relative w-full md:w-64">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input class="w-full pl-10 pr-4 py-3 bg-surface-container-lowest rounded-xl comic-border comic-shadow font-body-md focus:outline-none focus:border-tertiary-container focus:ring-0" placeholder="Search products..." type="text"/>
            </div>
            <button class="bg-primary text-on-primary font-label-bold text-label-bold py-3 px-6 rounded-xl comic-border-thick comic-shadow-lg comic-button-hover transition-all flex justify-center items-center gap-2 whitespace-nowrap">
                <span class="material-symbols-outlined">add_circle</span>
                Add Product
            </button>
        </div>
    </div>

    <!-- Filters Bar -->
    <div class="flex flex-wrap gap-3 mb-8">
        <button class="bg-on-surface text-surface py-2 px-5 rounded-full font-label-bold text-label-bold comic-border comic-shadow-sm">All ({{ $products->count() }})</button>
        <button class="bg-surface-container-lowest text-on-surface py-2 px-5 rounded-full font-label-bold text-label-bold comic-border hover:bg-surface-container-low transition-colors">Plushies</button>
        <button class="bg-surface-container-lowest text-on-surface py-2 px-5 rounded-full font-label-bold text-label-bold comic-border hover:bg-surface-container-low transition-colors">Stationery</button>
        <button class="bg-surface-container-lowest text-on-surface py-2 px-5 rounded-full font-label-bold text-label-bold comic-border hover:bg-surface-container-low transition-colors">Apparel</button>
        <button class="bg-surface-container-lowest text-on-surface py-2 px-5 rounded-full font-label-bold text-label-bold comic-border hover:bg-surface-container-low transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-sm">filter_list</span>
            More Filters
        </button>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-gutter">
        @php
            $placeholders = [
                'https://lh3.googleusercontent.com/aida-public/AB6AXuDQbBfRgfrXSd1DIdg-GA3AXr00dZkNCaTMAKp84Y-0bAOIhqUFU8K3eulU1BFx1bGxgfzu2U5Rt59MSTYXRYH2CUBiEFC3lVZSOEtvXzIy8ArGsVbjj_NH-16FFlrD_EptYJ0Wd4Q_XHKUNsjXvz3mmqNvBWcc0lytQ6taF1sJQJc5h61g1zznPLqNms4rqtlOMI8wucRXFxL57aqHvRXfrhEAlj-EfqScmKs3H7d7GiAUZ3DHoJGXMJWvpNLHPY9LjMJYUMDSUdBR',
                'https://lh3.googleusercontent.com/aida-public/AB6AXuCj_JrsJyeScg2qeoHaO2-G2HAieEfAK9Ch5bWyCdIEi-nWs0wDcpputYbE6Dcp2-047ms1d_TJJtd-8D6hDJTMxw99x7O9sYgw0AEH2TMMF5biLxieVL9O-ZTM-sX7E0D-86S23jaYt2GMZl9VhC85vbGLMoDv7vg70cPglx48XYoc06aIGiwjSgjRAFZ8Qgzi6qMuFreXUZh7Dju2VI1eoXK6tA_RzFCZdDRDK7hqE-hJR6iH2lfdkoQkFLioR58hgMmMy0-uZy4g',
                'https://lh3.googleusercontent.com/aida-public/AB6AXuDp8GdbeaYQoiNYK1CF1OEWDW49KFsotkcGY_JEPZnoALIK4O8fb7att9yt4b-VeQ0AjG2IdXYirkQcXiOkAj8eTbp40TpudGl5ztA5BymJMsQ20Btz14PQ3uRmSosx-7eIFG2oK-lYb9SvXyPicCpiZSxuKEpsIPdmmZocZyNbxAYTapUmyRtTtMoOA1RcZXLqGWs8BTGuD-2xfc88mKHVYJVqC1QLosqsqSFW82S6OGkv-O_ivPoCoGf_gUBMGk8WSrB3SBU4hEH3',
                'https://lh3.googleusercontent.com/aida-public/AB6AXuC48lHHprOmR_yIOTeVhl884F3PwLmicwx_muVrKmZjJ5My_6zbYHZEN2-slMZ5R5gP_RtUGl5dYCFVM6oK3XYLoo9n10oh_bgwdVp48e9SzpPbB25Sj3KU8sErwbDD31ryqwo951vb4n88nTWOtyjP-fQ_xnW_MCn1S317vLfE3j06QRY8OFnMidXWs8YhYfQEU-5JN8XUrrfrcNYpK7Da7N27obsV-tbpD_bcHiwwQl0jQJtZyeEX3DM8RslMqF8BbE-Ozd8zBt7g'
            ];
        @endphp

        @forelse($products as $index => $product)
        <div class="bg-surface-container-lowest rounded-xl p-4 comic-border comic-shadow-lg relative group {{ $product->total_stock == 0 ? 'opacity-75' : '' }}">
            @if($product->is_new)
            <div class="absolute -top-3 -right-3 bg-primary-container text-on-primary-container font-label-bold text-label-bold px-3 py-1 rounded-full comic-border sticker-rotate-reverse z-10">
                New!
            </div>
            @elseif($product->total_stock > 100)
            <div class="absolute -top-3 -right-3 bg-secondary-container text-on-secondary-container font-label-bold text-label-bold px-3 py-1 rounded-full comic-border sticker-rotate z-10">
                Top Seller!
            </div>
            @endif

            <div class="relative h-48 mb-4 bg-surface-container-low rounded-lg comic-border overflow-hidden">
                @if($product->total_stock == 0)
                <div class="absolute inset-0 bg-on-surface/10 z-10 flex items-center justify-center">
                    <span class="bg-error text-on-error font-label-bold px-4 py-2 rounded-full comic-border sticker-rotate-reverse">OUT OF STOCK</span>
                </div>
                @endif

                <img src="{{ $product->image ? asset('storage/' . $product->image) : $placeholders[$index % count($placeholders)] }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-cover {{ $index % 2 == 0 ? 'sticker-rotate' : 'sticker-rotate-reverse' }} transition-transform group-hover:scale-105 {{ $product->total_stock == 0 ? 'grayscale' : '' }}">
                
                <div class="absolute inset-0 bg-on-surface/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3 {{ $product->total_stock == 0 ? 'z-20' : '' }}">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-surface text-primary p-2 rounded-full comic-border hover:bg-primary-container transition-colors">
                        <span class="material-symbols-outlined">edit</span>
                    </a>
                    <button class="bg-surface text-error p-2 rounded-full comic-border hover:bg-error-container transition-colors">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </div>

            <div class="flex justify-between items-start mb-2">
                <h3 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface leading-tight line-clamp-1">{{ $product->name }}</h3>
            </div>

            <div class="flex items-center gap-2 mb-4">
                @if($product->total_stock == 0)
                    <span class="material-symbols-outlined text-error text-sm" style="font-variation-settings: 'FILL' 1;">cancel</span>
                    <span class="font-label-bold text-label-bold text-error">Out of Stock</span>
                @elseif($product->total_stock < 10)
                    <span class="material-symbols-outlined text-error text-sm" style="font-variation-settings: 'FILL' 1;">warning</span>
                    <span class="font-label-bold text-label-bold text-error">Low Stock: {{ $product->total_stock }}</span>
                @else
                    <span class="material-symbols-outlined text-tertiary-container text-sm" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
                    <span class="font-label-bold text-label-bold text-tertiary-container">In Stock: {{ $product->total_stock }}</span>
                @endif
            </div>

            <div class="flex justify-between items-end border-t-2 border-dashed border-surface-container-high pt-3">
                <span class="font-label-md text-label-md text-on-surface-variant">ID: #HV-{{ str_pad($product->id, 3, '0', STR_PAD_LEFT) }}</span>
                <div class="bg-primary-container px-3 py-1 rounded-lg comic-border {{ $index % 2 == 0 ? 'sticker-rotate-reverse' : 'sticker-rotate' }}">
                    <span class="font-price-display text-price-display text-on-primary-container">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full p-20 text-center animate-fade-in">
            <div class="bg-surface-container-lowest border-4 border-black rounded-[40px] comic-shadow-lg p-12 inline-block">
                <span class="material-symbols-outlined text-6xl text-primary mb-4 animate-bounce">inventory_2</span>
                <h3 class="font-headline-xl text-3xl italic font-black text-black">NO PRODUCTS YET!</h3>
                <p class="font-body-md text-on-surface-variant font-bold italic mt-2">Start adding some kawaii items to your store.</p>
                <button class="mt-6 bg-primary text-on-primary font-label-bold py-3 px-8 rounded-full comic-border-thick comic-shadow comic-button-hover transition-all inline-flex items-center gap-2">
                    <span class="material-symbols-outlined">add_circle</span>
                    First Product
                </button>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-10 flex justify-center items-center gap-2 pb-10">
        <button class="w-10 h-10 rounded-full bg-surface-container-lowest comic-border flex items-center justify-center hover:bg-surface-container-low transition-colors">
            <span class="material-symbols-outlined">chevron_left</span>
        </button>
        <button class="w-10 h-10 rounded-full bg-primary text-on-primary comic-border comic-shadow-sm font-label-bold text-label-bold flex items-center justify-center sticker-rotate">1</button>
        <button class="w-10 h-10 rounded-full bg-surface-container-lowest text-on-surface comic-border font-label-bold text-label-bold flex items-center justify-center hover:bg-surface-container-low transition-colors">2</button>
        <button class="w-10 h-10 rounded-full bg-surface-container-lowest text-on-surface comic-border font-label-bold text-label-bold flex items-center justify-center hover:bg-surface-container-low transition-colors">3</button>
        <span class="font-label-bold text-label-bold px-2">...</span>
        <button class="w-10 h-10 rounded-full bg-surface-container-lowest comic-border flex items-center justify-center hover:bg-surface-container-low transition-colors">
            <span class="material-symbols-outlined">chevron_right</span>
        </button>
    </div>
</div>
@endsection
