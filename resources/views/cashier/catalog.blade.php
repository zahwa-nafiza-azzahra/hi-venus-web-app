@extends('layouts.cashier')

@section('title', 'Katalog & Stok | Hi Venus')
@section('page_title', 'Katalog & Stok')

@section('content')
<div class="animate-fade-in">
    <!-- Header & Search -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
        <div>
            <h1 class="font-headline-xl text-headline-xl text-primary mb-2">Stok Barang ✨</h1>
            <p class="font-body-lg text-on-surface-variant">Intip koleksi lucu dan cek ketersediaan barang kamu!</p>
        </div>
        <div class="relative w-full md:w-96">
            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-outline">search</span>
            </div>
            <input class="w-full pl-12 pr-4 py-4 border-4 border-on-background rounded-xl bg-white focus:outline-none focus:ring-4 focus:ring-tertiary-container shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] font-label-bold" placeholder="Cari SKU atau Nama Produk..." type="text"/>
            <div class="absolute -top-3 -right-3">
                <span class="bg-secondary-container text-on-secondary-fixed text-[10px] px-3 py-1 border-2 border-on-background rounded-full font-black uppercase rotate-3 shadow-sm">Cari!</span>
            </div>
        </div>
    </div>

    <!-- Category Filter Pills -->
    <div class="flex flex-wrap gap-4 mb-10">
        <button class="px-8 py-2 bg-primary text-on-primary border-4 border-on-background rounded-full font-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 transition-transform">Semua</button>
        <button class="px-8 py-2 bg-white text-on-surface-variant border-4 border-on-background rounded-full font-label-bold hover:bg-primary-fixed transition-colors">Aksesoris</button>
        <button class="px-8 py-2 bg-white text-on-surface-variant border-4 border-on-background rounded-full font-label-bold hover:bg-primary-fixed transition-colors">Pakaian</button>
        <button class="px-8 py-2 bg-white text-on-surface-variant border-4 border-on-background rounded-full font-label-bold hover:bg-primary-fixed transition-colors">Stationery</button>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-gutter">
        @foreach($products as $product)
        <!-- Product Card -->
        <div class="bg-white border-4 border-on-background rounded-xl p-6 shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:scale-[1.02] transition-all relative overflow-hidden group">
            <div class="absolute top-4 right-4 z-10">
                @if($product->is_featured)
                <div class="bg-secondary-container text-on-secondary-fixed px-4 py-2 border-2 border-on-background rounded-lg font-black rotate-3 shadow-sm">
                    POPULER!
                </div>
                @endif
            </div>
            <div class="aspect-square w-full mb-6 bg-surface-container rounded-lg border-2 border-on-background overflow-hidden flex items-center justify-center relative">
                <img class="object-cover w-full h-full -rotate-2 group-hover:rotate-0 transition-transform duration-500" src="{{ $product->image ? asset('storage/'.$product->image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuCNezMVaOsSL_9VTkjbKVWqCVM3XGdQUHdJTRQtHRcXKYkyeIraG3kbd2XKDlNvOAuJn9EsArYl82t12wfWZWpF6fzOzI27thWi_e6WB23VQ6me2G2IpuAtgTBJAJAlBTrslgKks2fehCsUXD5SYZGavOPYLc1H7GJWQC8QHs-chlR2WULjSvUYL_GOBll2mT3SwfPBA9QQJW-IjIDsdp5w2LOEcsC926pGJZhwbPVkNlYU2b7t-EXeFi4rL-PwH0VVXAb7TPguh2xU' }}">
            </div>
            <div class="space-y-4">
                <div>
                    <span class="text-[12px] font-black text-tertiary uppercase tracking-wider">SKU: {{ $product->sku ?? 'HNV-'.str_pad($product->id, 3, '0', STR_PAD_LEFT) }}</span>
                    <h3 class="font-headline-lg text-on-surface leading-tight">{{ $product->name }}</h3>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-price-display text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    @php $totalStock = $product->variants->sum('stock'); @endphp
                    @if($totalStock > 10)
                        <span class="px-3 py-1 bg-green-200 text-green-800 border-2 border-green-800 rounded-lg font-black text-[12px]">STOK TERSEDIA</span>
                    @elseif($totalStock > 0)
                        <span class="px-3 py-1 bg-yellow-200 text-yellow-800 border-2 border-yellow-800 rounded-lg font-black text-[12px]">STOK MENIPIS</span>
                    @else
                        <span class="px-3 py-1 bg-red-200 text-red-800 border-2 border-red-800 rounded-lg font-black text-[12px]">STOK HABIS</span>
                    @endif
                </div>
                <div class="pt-4 border-t-2 border-on-background/10 space-y-3">
                    @foreach($product->variants as $variant)
                    <div class="flex justify-between items-center">
                        <span class="font-label-bold text-on-surface-variant">Varian: {{ $variant->name }}</span>
                        <span class="{{ $variant->stock > 5 ? 'bg-secondary' : 'bg-error' }} text-on-secondary px-2 py-0.5 rounded-md font-bold text-sm border-2 border-on-background">{{ $variant->stock }} Pcs</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Decorative Sparkle -->
            <span class="material-symbols-outlined absolute -bottom-2 -left-2 text-primary opacity-20 text-6xl rotate-12">auto_awesome</span>
        </div>
        @endforeach
    </div>
</div>
@endsection
