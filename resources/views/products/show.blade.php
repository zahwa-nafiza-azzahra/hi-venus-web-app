@extends('layouts.app')
@section('title', 'Gaun Pesta Satin Rose | Hi Venus Candy Boutique')

@section('content')
<div class="py-8 md:py-10">
<div class="bg-surface px-5 py-8 md:px-10 md:py-12">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 mb-stack-md text-on-surface-variant font-label text-label bg-white px-4 py-2 border-2 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] inline-flex mb-8">
        <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <a href="{{ route('products.index') }}" class="hover:text-primary">Koleksi</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-primary">{{ $product->name ?? 'Gaun Pesta Satin Rose' }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter lg:gap-stack-lg">
        {{-- Image Gallery --}}
        <div class="lg:col-span-7 space-y-4">
            <div class="aspect-[4/5] w-full rounded-2xl overflow-hidden bg-surface-container shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] border-4 border-on-background">
                <img id="main-product-img" src="{{ $product->image ? asset('storage/'.$product->image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuCSoRnA9U_MAQeRsnLbGsQLnIs9AyA9s40m-h1excGOTMuJJHVabF0eVstiKi60zGkKNWk0xi7ku1wZUbmlP7CeEL1rjj-gGTq_ggbsy-SYEwauHz7yA9zRVt2x2RCqcqFdUPxVnJMd78h7bikVs2Bc7rnCvyh1qLPnYjOc6TFptz40lXTnEj_M2z_r_Jwtv6ACn4Q3GzsB8j5uhsEa1ntxZt3XwwQsP_pwMqVzypT6SrOjErAPKb2oewEA_ibpjAC_5g8fiQpn7g' }}" alt="Product Hero" class="w-full h-full object-cover">
            </div>
            <div class="flex gap-3 overflow-x-auto pb-2">
                @php
                $thumbs = [
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuD0YBeHPaO1v-LtugZmskQv00ORbomy-_S_TCsIa5bue2Wal_6cEob5T7hOqrpUbNdI-m91f2LNSR0vikPwOA1-ZsngAp0TVdosGZNYo4uqIG3z7YjqJ6cRTuA9Vd8r-RGqaB36wYV9A0LmxXXKdLaGhaaflyZfR2Wt05zLP9r5VA4lGkxS7uqUcFrM8jIuwhQr36IvVN0HNCnfOOkqSMDfRgr39wJE04oK5R_Np7KA_0FsWFAaTPkn9PCDWdhiTEdFtcFICDVWCA',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuD9wXND3GqvDtWf8J-bOETvbXTZwdK46HVybQXWSHubApx-XocougZMvHboIdh4lNkAlChiQ063Bvfs6bIsB-kaqldVDSebr692TIE4ZcPPfh1xWsadrJawT0Hwy-9c0wANS19YyUz4jfEc1eI1bcUHNrc1YonfEfX1k9vJpe6Kir2DCMdm9UT9aOVHqszXndzCXs7kZFPYgF_wpS7BxWGcg5wGnpp6MpUUs7-pxQDDWLFj4hrwaRM6ZaZnuVdr9bG7m2m3nXzPRw',
                    'https://lh3.googleusercontent.com/aida-public/AB6AXuDI1gBsm3rAPP9RVKLH_LqvI4JNeOBFC7hW0aeYO79R7rkp6LEtK6MoZ1gzL-cT_FiIFedAHGDQheRIwx_PfgwGKsQIDUoiKnYrOgwYlIj2CGl1kvo_Da75SP6pwgxMvjprtMSoMdezV_SlxTV6WA_AEQdluPRbToG6qn6EgXv_-Z8zRj6sKdGYNfiTRTkL8Y8p0Uj6G1dZKPBPthP0GGgIZtJ8fJIo2207VSnZfx077Jt6GhIYz-6MLH2NkxO4WtL6U5yipkGJ8A',
                ];
                @endphp
                @foreach($thumbs as $i=>$thumb)
                <button onclick="document.getElementById('main-product-img').src='{{ $thumb }}'" class="flex-shrink-0 w-20 md:w-24 aspect-[4/5] rounded-xl overflow-hidden border-4 {{ $i==0 ? 'border-primary' : 'border-white hover:border-primary' }} transition-colors">
                    <img src="{{ $thumb }}" alt="Thumb {{ $i+1 }}" class="w-full h-full object-cover">
                </button>
                @endforeach
            </div>
        </div>

        {{-- Product Info --}}
        <div class="lg:col-span-5 flex flex-col gap-stack-md">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-secondary-fixed text-on-secondary-fixed text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Terlaris</span>
                    <div class="flex items-center text-accent-gold">
                        @for($i=0;$i<4;$i++)<span class="material-symbols-outlined text-[16px]" style="font-variation-settings:'FILL' 1;">star</span>@endfor
                        <span class="material-symbols-outlined text-[16px]" style="font-variation-settings:'FILL' 0.5;">star</span>
                        <span class="ml-1 text-on-surface-variant font-label text-label">(48 Ulasan)</span>
                    </div>
                </div>
                <h1 class="font-headline-xl text-[2.8rem] md:text-[4rem] mb-2 text-primary italic drop-shadow-[4px_4px_0px_#1b1c1c]">{{ $product->name ?? 'Gaun Pesta Satin Rose' }}</h1>
                <p class="text-secondary font-price-display text-3xl mb-3">Rp {{ number_format($product->price ?? 2450000, 0, ',', '.') }}</p>
                <p class="text-on-surface-variant text-body-lg leading-relaxed">{{ $product->description ?? 'Gaun pesta yang elegan dengan siluet A-line yang anggun.' }}</p>
            </div>

            {{-- Variants --}}
            <div class="space-y-stack-md border-y-4 border-on-background py-stack-md border-dashed">
                <div>
                    <span class="font-label-bold text-label-bold text-on-surface uppercase block mb-3">Pilihan Varian</span>
                    <div class="flex gap-3">
                        @foreach(['#FFB6C1', '#E6E6FA', '#FFF0F5'] as $c)
                        <button class="w-10 h-10 rounded-full border-4 border-on-background shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] hover:scale-110 transition-transform" style="background-color:{{ $c }}"></button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- CTA --}}
            <div class="flex flex-col gap-6">
                @auth
                <div class="flex items-center gap-4">
                    <div class="flex items-center border-4 border-on-background rounded-xl p-1 bg-white shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]">
                        <button class="w-12 h-12 flex items-center justify-center text-primary hover:bg-surface-container-high rounded-lg">
                            <span class="material-symbols-outlined">remove</span>
                        </button>
                        <span class="w-10 text-center font-black text-xl">1</span>
                        <button class="w-12 h-12 flex items-center justify-center text-primary hover:bg-surface-container-high rounded-lg">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                    </div>
                    <button class="flex-1 bg-primary text-on-primary border-4 border-on-background py-5 rounded-2xl font-headline-lg text-headline-lg shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:shadow-none transition-all flex items-center justify-center gap-3">
                        <span class="material-symbols-outlined">shopping_bag</span>
                        Tambah ke Keranjang
                    </button>
                </div>
                <div class="flex gap-4">
                    <button class="flex-1 border-4 border-on-background bg-secondary-container text-on-secondary-container font-label-bold py-4 rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:shadow-none transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">favorite</span> Favorit
                    </button>
                    <button class="flex-1 border-4 border-on-background bg-tertiary-container text-on-tertiary-container font-label-bold py-4 rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:shadow-none transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">share</span> Bagikan
                    </button>
                </div>
                @else
                <a href="{{ route('login') }}" class="w-full bg-primary text-on-primary border-4 border-on-background py-5 rounded-2xl font-headline-lg text-headline-lg shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:shadow-none transition-all flex items-center justify-center gap-3 no-underline">
                    <span class="material-symbols-outlined">login</span>
                    Login untuk Belanja
                </a>
                <p class="text-center text-on-surface-variant text-body-sm">Silakan login atau daftar akun untuk mulai berbelanja ✨</p>
                @endauth
            </div>

            <div class="grid grid-cols-2 gap-3 mt-2">
                <div class="flex items-center gap-2 p-3 bg-surface-container rounded-lg">
                    <span class="material-symbols-outlined text-primary">local_shipping</span>
                    <span class="text-[11px] font-label leading-tight">Gratis Ongkir Seluruh Indonesia</span>
                </div>
                <div class="flex items-center gap-2 p-3 bg-surface-container rounded-lg">
                    <span class="material-symbols-outlined text-primary">verified_user</span>
                    <span class="text-[11px] font-label leading-tight">Garansi 7 Hari Pengembalian</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <section class="mt-stack-lg border-t border-outline-variant pt-stack-md">
        <div class="flex gap-8 border-b border-outline-variant mb-stack-md overflow-x-auto">
            @foreach(['Deskripsi Produk','Detail Ukuran','Ulasan (48)','Info Pengiriman'] as $tab)
            <button class="pb-4 whitespace-nowrap {{ $loop->first ? 'border-b-2 border-primary text-primary font-bold' : 'border-b-2 border-transparent text-on-surface-variant hover:text-primary' }}">{{ $tab }}</button>
            @endforeach
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-lg">
            <div class="space-y-4">
                <h3 class="font-h3 text-h3 text-on-background" style="font-family:'Cherry Bomb One','Fredoka',cursive;">Elegan & Mewah</h3>
                <p class="text-on-surface-variant leading-relaxed">Dirancang khusus untuk wanita modern yang menghargai keindahan klasik. Gaun Satin Rose memiliki potongan mengikuti lekuk tubuh dengan sempurna.</p>
                <ul class="space-y-2">
                    @foreach(['Bahan Satin Duchess Premium dengan kilau matte yang mewah.','Lapisan furing sutra yang lembut dan tidak panas di kulit.','Detail ritsleting tersembunyi untuk tampilan clean.'] as $feat)
                    <li class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-primary text-[18px]" style="font-variation-settings:'FILL' 1;">check_circle</span>
                        <span class="text-body-sm text-on-surface-variant">{{ $feat }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="bg-surface-container rounded-2xl p-6">
                <h4 class="font-bold text-on-background mb-4">Ulasan Terbaru</h4>
                @foreach([['name'=>'Amanda Clarissa','rating'=>5,'text'=>'"Gaunnya cantik sekali! Pas di badan dan kainnya benar-benar terasa mahal."'],['name'=>'Siti Rahma','rating'=>4,'text'=>'"Warnanya sedikit lebih gelap dari foto tapi tetap sangat bagus."']] as $review)
                <div class="border-b border-outline-variant pb-4 last:border-0 mb-4 last:mb-0">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-bold text-body-sm">{{ $review['name'] }}</span>
                        <span class="text-accent-gold flex gap-0.5">
                            @for($i=0;$i<$review['rating'];$i++)<span class="material-symbols-outlined text-[14px]" style="font-variation-settings:'FILL' 1;">star</span>@endfor
                        </span>
                    </div>
                    <p class="text-on-surface-variant text-body-sm italic">{{ $review['text'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Related Products --}}
    <section class="mt-stack-lg">
        <div class="flex justify-between items-end mb-stack-md">
            <div>
                <h2 class="font-h2 text-h2 text-on-background" style="font-family:'Cherry Bomb One','Fredoka',cursive;">Produk Terkait</h2>
                <p class="text-on-surface-variant text-body-sm">Lengkapi koleksi fashion mewah Anda</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-primary font-button border-b border-primary pb-1">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-gutter">
            @php $related = [['name'=>'Silk Azure Cocktail','price'=>'1.890.000','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuC2Ean8PYtGxOV-hmusGdUUToLTKddgeAl5Mn3MeiXDQmUVQNBmEdrMjnNulCK-IuuBAoVIkZyYGFdyGGQk9JEDRr-bblDErnPPYI8kWFE89smdaY1Nyvs5-fN1mlURCKo9zIdsp2TjteSrusQVo-kYbXL2K1AddSvu48MX7kdljQmfj7vwBRZc1ib5jMaDJLLRac14vwNjWBkAd0yTusMQPY-4ZVUp6fqfUP6KTS3sWT60UxKApQp8BngPj8SRFBjEfWXLff_y6g'],['name'=>'Vintage Lace Pearl','price'=>'2.150.000','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuAbpd2KD2T7Tyq1Otkhc1Hs9xXJKaIfoS4XzCArl1P5XOG6Wo9l8uUnExV4vBGnYMWHHsVoBbzogCzqaouT5lOga59TBf7scQz5GpjDq_ILiO6T8PDjQGGGf-6RLlAIrfvLl64baflcpCKvHX4FvkW60lu769w0CrlTiVWn-G3L6LkEUedgzZNaQAPfrOxHF5WKEl6_54pBmLCk44Pj52GozWGwNfx3ud00HB383vVFkAE7l9cSUTIPipCcmFpYXP2VBQbS-hNxPg'],['name'=>'Night Velvet Gown','price'=>'3.200.000','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuCP1Fuag_5woJXIPoxcdCi0sJBkJSpe3WQ8qbcTctma9WKTOs7QFR9LxqRhh-MnBWkh0jDDrDc_Cms0DWNDf86oAOwdCJNQKlCOQBs5pjWzjHpkYZ7K70YoSHlIkxZo24BAw5ns0rtmWNVjCWiCVaaRfCRfnUE4FErnF76qLAQGaMnhferwv8WF9HLQOTbotjOv2XBzX9IqryvEz4bCUr5ZwxrJkkD_NQYSkxPa6HiFch5h1xGUrEB7PVQTaMu-jA_sPFtM8lh3-Q'],['name'=>'Champagne Pleated','price'=>'1.550.000','img'=>'https://lh3.googleusercontent.com/aida-public/AB6AXuCth6QcSEjIgja_HhP_OjmkmShdv7XwTOoMQV2xnpsCCpJvia3LRI9sWWW5CK6fq0VjsiUBZxZSYruf-E_zPOIsbMI5EBWD3hYj9ZbI_7XaH5iX-6RehqBIBDMGGfRqfosm3YEs1fGoVIc2ELHs1IvQcnuQCWLAb0yURJ44YaBT6e1cGY5aaz8VJTgrqqK1gPMIFIL0Gh2bNHB7RgmhuyN8ZbKf9NtDoF-4_OCnXgYMoQHphknJIXqCFQDPbfFocseyxFZ8e7Tdfw']]; @endphp
            @foreach($related as $r)
            <div class="group cursor-pointer">
                <div class="aspect-[3/4] rounded-xl overflow-hidden bg-surface-container relative mb-3 shadow-sm transition-all duration-300 group-hover:shadow-md group-hover:scale-[1.02]">
                    <img src="{{ $r['img'] }}" alt="{{ $r['name'] }}" class="w-full h-full object-cover">
                    <button class="absolute top-2 right-2 w-8 h-8 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center text-primary opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="material-symbols-outlined text-[20px]">favorite</span>
                    </button>
                </div>
                <h4 class="font-bold text-on-background group-hover:text-primary transition-colors text-sm">{{ $r['name'] }}</h4>
                <p class="text-primary font-bold text-body-sm">Rp {{ $r['price'] }}</p>
            </div>
            @endforeach
        </div>
    </section>
</div>
</div>
@endsection


