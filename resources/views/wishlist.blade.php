@extends('layouts.app')

@section('title', 'Wishlist Kamu! | Hi Venus')

@section('body_class', 'bg-checkerboard')

@push('styles')
<style>
    .bg-checkerboard {
        background-color: #ffffff;
        background-image: linear-gradient(45deg, #c1e8ff 25%, transparent 25%), 
                          linear-gradient(-45deg, #c1e8ff 25%, transparent 25%), 
                          linear-gradient(45deg, transparent 75%, #c1e8ff 75%), 
                          linear-gradient(-45deg, transparent 75%, #c1e8ff 75%);
        background-size: 40px 40px;
        background-position: 0 0, 0 20px, 20px -20px, -20px 0px;
    }
    .sticker-rotate-right { transform: rotate(3deg); }
    .sticker-rotate-left { transform: rotate(-3deg); }
</style>
@endpush

@section('content')
<main class="max-w-7xl mx-auto p-margin-mobile md:p-margin-desktop py-12 relative z-10">
    {{-- Header Section --}}
    <header class="mb-16 relative inline-block animate-fade-in-down">
        <h1 class="font-headline-xl text-headline-xl text-primary drop-shadow-[4px_4px_0px_rgba(27,28,28,1)] italic">Wishlist Kamu!</h1>
        <span class="absolute -top-10 -right-16 material-symbols-outlined text-secondary-container text-6xl rotate-12 drop-shadow-[2px_2px_0px_rgba(0,0,0,1)]" style="font-variation-settings: 'FILL' 1;">stars</span>
        <span class="absolute -bottom-6 -left-12 material-symbols-outlined text-primary-container text-5xl -rotate-12 drop-shadow-[2px_2px_0px_rgba(0,0,0,1)]" style="font-variation-settings: 'FILL' 1;">favorite</span>
    </header>

    @include('components.flash-messages')

    {{-- Grid Items --}}
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter mb-section-gap">
        @forelse($wishlists as $wish)
        @php $p = $wish->product; @endphp
        {{-- Item --}}
        <div class="bg-surface-container-lowest border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] p-6 relative group hover:-translate-y-1 hover:translate-x-1 hover:shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] transition-all animate-scale-in">
            <div class="aspect-square bg-tertiary-fixed border-4 border-on-background mb-4 overflow-hidden relative">
                <img class="w-full h-full object-cover -rotate-3 group-hover:rotate-0 transition-transform duration-300" src="{{ $p->image ? $p->image_url : 'https://lh3.googleusercontent.com/aida-public/AB6AXuC7hQjMKr-I4FiKO77l686kTHlpVcH8GQGJMApwkJc5f7bS8CVt3xu4ljvs55Aac3uJMbXQtM9PFEQdzsdzGahpu9LyYuowv745FNFLthLAMITi7VSPz7Dshmst7kJjpnUvPAktI9cCOKX6kb8cN6INxLBVbXKFQEP9zrpothTQaSA3D_aCQtixtdaozNG5GSUrQwkVsly4DGGPWTgJcYOX3cKBqt0HOTN19awWewwuoPwOPjcH0JKoqoyOSKym0u9OHnhleKG73wmx' }}" alt="{{ $p->name }}">
                <form action="{{ route('wishlist.toggle', $p->id) }}" method="POST" class="absolute top-4 right-4">
                    @csrf
                    <button type="submit" class="bg-white border-3 border-on-background p-2 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:scale-110 transition-transform active:translate-y-1 active:shadow-none">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">favorite</span>
                    </button>
                </form>
            </div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="font-headline-lg text-headline-lg text-on-surface mb-1">{{ $p->name }}</h3>
                    <p class="font-body-md text-on-surface-variant">{{ $p->category->name }}</p>
                </div>
                <div class="bg-secondary-container border-4 border-on-background p-2 rotate-6">
                    <span class="font-price-display text-price-display text-on-secondary-container">Rp {{ number_format($p->price / 1000, 0) }}k</span>
                </div>
            </div>
            <form action="{{ route('cart.add', $p->id) }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-4 bg-primary text-on-primary font-label-bold text-label-bold border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] flex items-center justify-center gap-2 hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all active:bg-primary-container">
                    <span class="material-symbols-outlined">add_shopping_cart</span>
                    TAMBAH KE KERANJANG
                </button>
            </form>
        </div>
        @empty
        {{-- Empty State Section (Only show when empty) --}}
        <div class="col-span-full">
            <section class="bg-surface-container border-4 border-on-background p-12 text-center relative overflow-hidden animate-fade-in-up">
                <div class="max-w-xl mx-auto relative z-10">
                    <div class="relative inline-block mb-8">
                        <div class="w-40 h-40 bg-white border-4 border-on-background rounded-full flex items-center justify-center shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] mx-auto overflow-hidden rotate-3 hover:rotate-0 transition-transform">
                            <img class="w-full h-full object-cover" src="https://api.dicebear.com/7.x/avataaars/svg?seed=sad-venus" alt="Sad character">
                        </div>
                        <span class="absolute -top-4 -right-6 material-symbols-outlined text-error text-5xl animate-pulse" style="font-variation-settings: 'FILL' 1;">heart_broken</span>
                    </div>
                    <h2 class="font-headline-lg text-headline-lg text-on-surface mb-4 italic">Wishlist Masih Kosong? 🥺</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant mb-10">Duh, barang impian kamu masih belum ada di sini. Ayo cari koleksi lucu lainnya biar hati tenang! ✨</p>
                    <a href="{{ route('products.index') }}" class="inline-block px-12 py-5 bg-secondary-container text-on-secondary-container font-headline-lg text-headline-lg border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all active:scale-95">
                        MULAI BELANJA! 🛍️
                    </a>
                </div>
            </section>
        </div>
        @endforelse
    </section>
        
        {{-- Decorative Background Icons --}}
        <div class="absolute top-8 left-8 opacity-10 rotate-12">
            <span class="material-symbols-outlined text-[120px]">sentiment_dissatisfied</span>
        </div>
        <div class="absolute bottom-8 right-8 opacity-10 -rotate-12">
            <span class="material-symbols-outlined text-[120px]">sentiment_very_dissatisfied</span>
        </div>
    </section>
</main>
@endsection
