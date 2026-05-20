@extends('layouts.app')
@section('title', ($product->name ?? 'Detail Produk') . ' | Hi Venus')

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
<main class="flex-grow flex flex-col gap-gutter p-margin-mobile md:p-margin-desktop max-w-[1200px] mx-auto w-full">
    
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 mb-4 text-on-background font-label-bold text-label-bold bg-surface-bright px-6 py-3 rounded-full border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] w-max max-w-full overflow-x-auto whitespace-nowrap animate-fade-in-left">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
        <span class="material-symbols-outlined text-[18px]">chevron_right</span>
        <a href="{{ route('products.index') }}" class="hover:text-primary transition-colors">Shop</a>
        <span class="material-symbols-outlined text-[18px]">chevron_right</span>
        <span class="text-primary italic">{{ $product->name ?? 'Detail' }}</span>
    </nav>

    <div class="flex flex-col md:flex-row gap-8 items-start animate-fade-in w-full">
        {{-- Image Gallery --}}
        <div class="w-full md:w-5/12 space-y-4 min-w-0 lg:max-w-[500px]">
            <div class="aspect-square w-full rounded-2xl overflow-hidden bg-surface-variant border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] relative p-4 flex items-center justify-center">
                <!-- Decorative Elements -->
                <div class="absolute -top-4 -left-4 bg-tertiary-fixed text-on-background border-4 border-on-background rounded-full font-label-bold text-label-bold px-3 py-1 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] -rotate-12 z-20 animate-pulse">
                    CUTE!
                </div>
                <img id="main-product-img" src="{{ $product->image ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuCSoRnA9U_MAQeRsnLbGsQLnIs9AyA9s40m-h1excGOTMuJJHVabF0eVstiKi60zGkKNWk0xi7ku1wZUbmlP7CeEL1rjj-gGTq_ggbsy-SYEwauHz7yA9zRVt2x2RCqcqFdUPxVnJMd78h7bikVs2Bc7rnCvyh1qLPnYjOc6TFptz40lXTnEj_M2z_r_Jwtv6ACn4Q3GzsB8j5uhsEa1ntxZt3XwwQsP_pwMqVzypT6SrOjErAPKb2oewEA_ibpjAC_5g8fiQpn7g' }}" alt="Product Hero" class="w-full h-full object-cover rounded-xl border-4 border-on-background">
            </div>
            <div class="flex gap-4 overflow-x-auto pb-4 pt-2 px-2 -mx-2 w-full">
                @php
                $thumbs = [
                    $product->image ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuCSoRnA9U_MAQeRsnLbGsQLnIs9AyA9s40m-h1excGOTMuJJHVabF0eVstiKi60zGkKNWk0xi7ku1wZUbmlP7CeEL1rjj-gGTq_ggbsy-SYEwauHz7yA9zRVt2x2RCqcqFdUPxVnJMd78h7bikVs2Bc7rnCvyh1qLPnYjOc6TFptz40lXTnEj_M2z_r_Jwtv6ACn4Q3GzsB8j5uhsEa1ntxZt3XwwQsP_pwMqVzypT6SrOjErAPKb2oewEA_ibpjAC_5g8fiQpn7g',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuD0YBeHPaO1v-LtugZmskQv00ORbomy-_S_TCsIa5bue2Wal_6cEob5T7hOqrpUbNdI-m91f2LNSR0vikPwOA1-ZsngAp0TVdosGZNYo4uqIG3z7YjqJ6cRTuA9Vd8r-RGqaB36wYV9A0LmxXXKdLaGhaaflyZfR2Wt05zLP9r5VA4lGkxS7uqUcFrM8jIuwhQr36IvVN0HNCnfOOkqSMDfRgr39wJE04oK5R_Np7KA_0FsWFAaTPkn9PCDWdhiTEdFtcFICDVWCA',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuD9wXND3GqvDtWf8J-bOETvbXTZwdK46HVybQXWSHubApx-XocougZMvHboIdh4lNkAlChiQ063Bvfs6bIsB-kaqldVDSebr692TIE4ZcPPfh1xWsadrJawT0Hwy-9c0wANS19YyUz4jfEc1eI1bcUHNrc1YonfEfX1k9vJpe6Kir2DCMdm9UT9aOVHqszXndzCXs7kZFPYgF_wpS7BxWGcg5wGnpp6MpUUs7-pxQDDWLFj4hrwaRM6ZaZnuVdr9bG7m2m3nXzPRw',
                ];
                @endphp
                @foreach($thumbs as $i=>$thumb)
                <button onclick="document.getElementById('main-product-img').src='{{ $thumb }}'" class="flex-shrink-0 w-20 md:w-24 aspect-square rounded-xl overflow-hidden border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all {{ $i==0 ? 'bg-primary-container' : 'bg-surface-variant' }}">
                    <img src="{{ $thumb }}" alt="Thumb {{ $i+1 }}" class="w-full h-full object-cover">
                </button>
                @endforeach
            </div>
        </div>

        {{-- Product Info --}}
        <div class="w-full md:w-7/12 flex flex-col gap-6 bg-surface-bright border-4 border-on-background p-8 rounded-2xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] animate-fade-in-right relative min-w-0">
            
            <div class="absolute -top-6 -right-6 bg-secondary-fixed text-on-secondary-fixed border-4 border-on-background rounded-full p-3 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] rotate-12 z-20 hover:rotate-45 transition-transform">
                <span class="material-symbols-outlined text-4xl">stars</span>
            </div>

            <div class="w-full">
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="bg-secondary-fixed text-on-secondary-fixed border-4 border-on-background text-xs font-black px-4 py-1.5 rounded-full uppercase tracking-wider shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] rotate-[-2deg]">Terlaris</span>
                    <div class="flex items-center text-primary bg-primary-container border-4 border-on-background px-4 py-1.5 rounded-full shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] rotate-[1deg]">
                        @for($i=0;$i<4;$i++)<span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' 1;">star</span>@endfor
                        <span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' 0.5;">star_half</span>
                        <span class="ml-2 text-on-background font-label-bold text-sm">(48 Ulasan)</span>
                    </div>
                </div>
                
                <h1 class="font-headline-xl text-5xl md:text-6xl mb-4 text-primary italic drop-shadow-[4px_4px_0px_#1b1c1c] leading-tight break-words">
                    {{ $product->name ?? 'Super Cute Item' }}
                </h1>
                
                <div class="bg-surface border-4 border-on-background p-4 rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] rotate-[1deg] mb-6 inline-block w-full sm:w-auto">
                    <p class="text-on-background font-price-display text-4xl truncate">Rp {{ number_format($product->price ?? 245000, 0, ',', '.') }}</p>
                </div>
                
                <p class="text-on-surface-variant text-body-lg leading-relaxed font-medium bg-surface-variant p-4 rounded-xl border-4 border-on-background border-dashed w-full break-words">
                    {{ $product->description ?? 'Deskripsi produk yang lucu dan detail akan ditampilkan di sini. Sangat cocok untuk kamu!' }}
                </p>
            </div>

            {{-- Variants --}}
            <div class="py-4 border-t-4 border-on-background border-dashed w-full">
                <span class="font-headline-lg text-xl text-on-background italic block mb-3">Pilihan Warna:</span>
                <div class="flex gap-4 flex-wrap">
                    @foreach(['#FFB6C1' => 'Pink', '#E6E6FA' => 'Purple', '#a7f3d0' => 'Mint'] as $hex => $name)
                    <button class="w-12 h-12 flex-shrink-0 rounded-full border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all flex items-center justify-center relative group" style="background-color:{{ $hex }}">
                        <span class="absolute -top-10 bg-on-background text-surface font-label-bold px-2 py-1 rounded-lg text-xs opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap">{{ $name }}</span>
                    </button>
                    @endforeach
                </div>
            </div>

            <div class="py-4 border-t-4 border-on-background border-dashed w-full">
                <span class="font-headline-lg text-xl text-on-background italic block mb-3">Pilihan Ukuran:</span>
                <div class="flex gap-4 flex-wrap">
                    @foreach(['S', 'M', 'L', 'XL'] as $size)
                    <button class="w-12 h-12 flex-shrink-0 rounded-xl border-4 border-on-background font-black text-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all flex items-center justify-center {{ $loop->first ? 'bg-primary text-on-primary' : 'bg-surface text-on-background hover:bg-primary-container' }}">
                        {{ $size }}
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- CTA --}}
            <div class="flex flex-col gap-4 mt-2 w-full">
                @auth
                <form action="{{ route('cart.add', $product->id ?? 1) }}" method="POST" class="flex flex-col sm:flex-row gap-4 w-full">
                    @csrf
                    <div class="flex items-center border-4 border-on-background rounded-xl bg-surface shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] flex-shrink-0 w-full sm:w-auto h-[60px]">
                        <button type="button" class="w-12 h-full flex items-center justify-center text-on-background hover:bg-surface-variant rounded-l-lg transition-colors border-r-4 border-on-background">
                            <span class="material-symbols-outlined font-bold">remove</span>
                        </button>
                        <input type="number" name="quantity" value="1" min="1" class="w-16 h-full text-center font-black text-xl bg-transparent focus:outline-none focus:ring-0 appearance-none">
                        <button type="button" class="w-12 h-full flex items-center justify-center text-on-background hover:bg-surface-variant rounded-r-lg transition-colors border-l-4 border-on-background">
                            <span class="material-symbols-outlined font-bold">add</span>
                        </button>
                    </div>
                    
                    <button type="submit" class="flex-grow bg-primary text-on-primary border-4 border-on-background h-[60px] rounded-xl font-headline-lg text-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all flex items-center justify-center gap-3">
                        <span class="material-symbols-outlined">shopping_bag</span>
                        Tambah
                    </button>
                </form>
                
                <div class="flex flex-col sm:flex-row gap-4 w-full">
                    <button type="button" class="flex-1 bg-secondary-container text-on-secondary-container border-4 border-on-background h-[50px] rounded-xl font-label-bold text-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">favorite</span> Favorit
                    </button>
                    <button type="button" class="flex-1 bg-tertiary-container text-on-tertiary-container border-4 border-on-background h-[50px] rounded-xl font-label-bold text-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">share</span> Bagikan
                    </button>
                </div>
                @else
                <a href="{{ route('login') }}" class="w-full bg-primary text-on-primary border-4 border-on-background py-5 rounded-2xl font-headline-lg text-2xl shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all flex items-center justify-center gap-3 no-underline">
                    <span class="material-symbols-outlined text-3xl">login</span>
                    Login
                </a>
                <p class="text-center font-label-bold text-on-surface-variant mt-2 border-4 border-on-background border-dashed bg-surface-variant p-3 rounded-xl rotate-[-1deg] break-words">
                    Silakan login atau daftar akun untuk berbelanja ✨
                </p>
                @endauth
            </div>

            <div class="flex flex-col sm:flex-row gap-4 mt-2 w-full">
                <div class="flex-1 flex items-center gap-3 p-3 bg-surface border-4 border-on-background rounded-xl shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 transition-transform min-w-0">
                    <span class="material-symbols-outlined text-primary text-2xl bg-primary-container p-1.5 rounded-full border-2 border-on-background flex-shrink-0">local_shipping</span>
                    <span class="text-sm font-label-bold leading-tight truncate">Gratis Ongkir se-Indonesia</span>
                </div>
                <div class="flex-1 flex items-center gap-3 p-3 bg-surface border-4 border-on-background rounded-xl shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 transition-transform min-w-0">
                    <span class="material-symbols-outlined text-tertiary text-2xl bg-tertiary-container p-1.5 rounded-full border-2 border-on-background flex-shrink-0">verified_user</span>
                    <span class="text-sm font-label-bold leading-tight truncate">Garansi 7 Hari Pengembalian</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs Section --}}
    <section class="mt-section-gap bg-surface-bright border-4 border-on-background rounded-2xl p-6 md:p-10 shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] z-10">
        <div class="flex gap-4 border-b-4 border-on-background mb-8 overflow-x-auto pb-4 custom-scrollbar">
            @foreach(['Deskripsi Detail','Panduan Ukuran','Ulasan (48)','Pengiriman'] as $tab)
            <button class="px-6 py-3 whitespace-nowrap font-headline-lg text-lg rounded-t-xl border-4 border-b-0 border-on-background {{ $loop->first ? 'bg-primary text-on-primary translate-y-1 mb-[-4px]' : 'bg-surface-variant text-on-surface hover:bg-surface transition-colors mb-[-4px]' }}">
                {{ $tab }}
            </button>
            @endforeach
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <h3 class="font-headline-xl text-3xl text-on-background italic drop-shadow-[2px_2px_0px_#1b1c1c]">Sangat Menggemaskan!</h3>
                <p class="font-body-lg text-on-surface-variant leading-relaxed">
                    Produk ini dirancang khusus dengan bahan berkualitas super premium yang lembut di kulit. Jahitannya rapi dan warnanya sangat cerah, tidak mudah pudar meskipun dicuci berulang kali. Sempurna untuk OOTD kamu!
                </p>
                <ul class="space-y-4 font-label-bold">
                    @foreach(['Bahan premium yang lembut dan breathable','Warna pastel yang kawaii dan cerah','Detail menggemaskan di setiap sudut'] as $feat)
                    <li class="flex items-start gap-3 bg-primary-container border-4 border-on-background p-3 rounded-xl shadow-[2px_2px_0px_0px_rgba(27,28,28,1)]">
                        <span class="material-symbols-outlined text-primary text-xl bg-white rounded-full">check_circle</span>
                        <span class="text-on-background">{{ $feat }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            
            <div class="bg-surface-variant border-4 border-on-background rounded-2xl p-6 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] rotate-[1deg]">
                <h4 class="font-headline-lg text-2xl text-on-background mb-6 italic">Ulasan Terbaru</h4>
                @foreach([['name'=>'Zahwa N.','rating'=>5,'text'=>'"Sumpah lucuuuu banget! Bahannya juga adem, dapet stiker gratis lagi di dalem paketnya. Luvvv!"'],['name'=>'Aulia R.','rating'=>5,'text'=>'"Pengirimannya super cepat dan packaging-nya aman banget. Produk sesuai gambar!"']] as $review)
                <div class="bg-white border-4 border-on-background p-4 rounded-xl shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] mb-4 last:mb-0 transform {{ $loop->first ? 'rotate-[-1deg]' : 'rotate-[1deg]' }}">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-black text-lg">{{ $review['name'] }}</span>
                        <span class="text-primary flex gap-0.5 bg-primary-container px-2 py-1 rounded-full border-2 border-on-background">
                            @for($i=0;$i<$review['rating'];$i++)<span class="material-symbols-outlined text-[14px]" style="font-variation-settings:'FILL' 1;">star</span>@endfor
                        </span>
                    </div>
                    <p class="text-on-surface-variant font-body-md italic">{{ $review['text'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Related Products --}}
    <section class="mt-section-gap mb-section-gap z-10">
        <div class="flex flex-col sm:flex-row justify-between items-end mb-8 gap-4 bg-surface-bright border-4 border-on-background p-6 rounded-2xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)]">
            <div>
                <h2 class="font-headline-xl text-4xl text-primary italic drop-shadow-[2px_2px_0px_#1b1c1c] mb-2">Koleksi Terkait</h2>
                <p class="font-label-bold text-on-surface-variant">Kamu mungkin juga suka item lucu ini!</p>
            </div>
            <a href="{{ route('products.index') }}" class="bg-secondary-container text-on-secondary-container font-label-bold border-4 border-on-background px-6 py-3 rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all flex items-center gap-2 whitespace-nowrap">
                Lihat Semua <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter stagger-container">
            @php $related = [['id'=>1,'name'=>'Strawberry Bag','price'=>'150.000','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuC2Ean8PYtGxOV-hmusGdUUToLTKddgeAl5Mn3MeiXDQmUVQNBmEdrMjnNulCK-IuuBAoVIkZyYGFdyGGQk9JEDRr-bblDErnPPYI8kWFE89smdaY1Nyvs5-fN1mlURCKo9zIdsp2TjteSrusQVo-kYbXL2K1AddSvu48MX7kdljQmfj7vwBRZc1ib5jMaDJLLRac14vwNjWBkAd0yTusMQPY-4ZVUp6fqfUP6KTS3sWT60UxKApQp8BngPj8SRFBjEfWXLff_y6g'],['id'=>2,'name'=>'Bunny Hat','price'=>'95.000','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuAbpd2KD2T7Tyq1Otkhc1Hs9xXJKaIfoS4XzCArl1P5XOG6Wo9l8uUnExV4vBGnYMWHHsVoBbzogCzqaouT5lOga59TBf7scQz5GpjDq_ILiO6T8PDjQGGGf-6RLlAIrfvLl64baflcpCKvHX4FvkW60lu769w0CrlTiVWn-G3L6LkEUedgzZNaQAPfrOxHF5WKEl6_54pBmLCk44Pj52GozWGwNfx3ud00HB383vVFkAE7l9cSUTIPipCcmFpYXP2VBQbS-hNxPg'],['id'=>3,'name'=>'Pastel Cardigan','price'=>'210.000','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuCP1Fuag_5woJXIPoxcdCi0sJBkJSpe3WQ8qbcTctma9WKTOs7QFR9LxqRhh-MnBWkh0jDDrDc_Cms0DWNDf86oAOwdCJNQKlCOQBs5pjWzjHpkYZ7K70YoSHlIkxZo24BAw5ns0rtmWNVjCWiCVaaRfCRfnUE4FErnF76qLAQGaMnhferwv8WF9HLQOTbotjOv2XBzX9IqryvEz4bCUr5ZwxrJkkD_NQYSkxPa6HiFch5h1xGUrEB7PVQTaMu-jA_sPFtM8lh3-Q'],['id'=>4,'name'=>'Ribbon Hairclip','price'=>'35.000','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuCth6QcSEjIgja_HhP_OjmkmShdv7XwTOoMQV2xnpsCCpJvia3LRI9sWWW5CK6fq0VjsiUBZxZSYruf-E_zPOIsbMI5EBWD3hYj9ZbI_7XaH5iX-6RehqBIBDMGGfRqfosm3YEs1fGoVIc2ELHs1IvQcnuQCWLAb0yURJ44YaBT6e1cGY5aaz8VJTgrqqK1gPMIFIL0Gh2bNHB7RgmhuyN8ZbKf9NtDoF-4_OCnXgYMoQHphknJIXqCFQDPbfFocseyxFZ8e7Tdfw']]; @endphp
            @foreach($related as $idx => $r)
            <div class="bg-surface-bright border-4 border-on-background p-4 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] relative flex flex-col items-center group hover:-translate-y-2 transition-transform duration-300">
                <div class="absolute -top-4 -right-4 bg-tertiary-container text-on-tertiary-container border-4 border-on-background rounded-full font-price-display text-price-display px-4 py-2 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] {{ $idx % 2 == 0 ? 'rotate-12' : '-rotate-6' }} z-20 group-hover:scale-110 transition-transform">
                    Rp {{ explode('.', $r['price'])[0] }}k
                </div>
                
                <div class="bg-surface-variant border-4 border-on-background rounded-lg overflow-hidden w-full aspect-square mb-4 group-hover:{{ $idx % 2 == 0 ? '-rotate-2' : 'rotate-2' }} transition-transform cursor-pointer">
                    <img src="{{ $r['img'] }}" alt="{{ $r['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <h3 class="font-body-lg text-body-lg font-bold text-center leading-tight min-h-[3rem] flex items-center">{{ $r['name'] }}</h3>
                <a href="{{ route('products.show', $r['id']) }}" class="w-full bg-primary text-on-primary border-4 border-on-background rounded-lg py-3 mt-4 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all flex justify-center items-center gap-2">
                    <span class="material-symbols-outlined">visibility</span> Lihat Detail
                </a>
            </div>
            @endforeach
        </div>
    </section>
</main>
@endsection
