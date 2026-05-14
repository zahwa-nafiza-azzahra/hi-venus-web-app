@extends('layouts.app')

@section('title', 'Beri Ulasan | Hi Venus')

@section('body_class', 'heart-pattern')

    @push('styles')
        <style>
            .heart-pattern {
                background-color: #fcf9f8;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath fill='%23ff85d0' fill-opacity='0.2' d='M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z'/%3E%3C/svg%3E");
                background-size: 48px 48px;
            }

            .comic-border {
                border: 4px solid #1b1c1c;
            }

            .comic-shadow {
                box-shadow: 8px 8px 0px 0px rgba(27, 28, 28, 1);
            }
        </style>
    @endpush

@section('content')
<main class="max-w-4xl mx-auto px-4 py-12 relative z-10">
    <div class="bg-surface-container-lowest border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] p-8 relative overflow-hidden animate-fade-in-up">
        <!-- Decorative Stickers -->
        <div class="absolute -top-4 -right-4 rotate-12 bg-secondary-container border-2 border-on-background p-2 rounded-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hidden md:block">
            <span class="material-symbols-outlined text-4xl text-on-secondary-container" style="font-variation-settings: 'FILL' 1;">sparkles</span>
        </div>
        <div class="absolute -bottom-2 left-10 -rotate-6 bg-tertiary-container border-2 border-on-background p-2 rounded-full shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hidden md:block">
            <span class="material-symbols-outlined text-2xl text-white" style="font-variation-settings: 'FILL' 1;">favorite</span>
        </div>

        <!-- Header Section -->
        <header class="text-center mb-10">
            <h1 class="font-headline-xl text-headline-xl text-primary italic mb-2">Beri Ulasan</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant">Bagikan keceriaanmu bersama produk kami! ✨</p>
        </header>

        <!-- Product Info Card -->
        <div class="flex flex-col md:flex-row items-center gap-6 bg-surface-container-low border-4 border-on-background p-6 mb-10 rounded-2xl transform -rotate-1">
            <div class="w-32 h-32 bg-white border-2 border-on-background rounded-xl rotate-3 overflow-hidden flex-shrink-0 shadow-sm">
                <img alt="{{ $product->name }}" class="w-full h-full object-cover" src="{{ $product->image ? asset('storage/'.$product->image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuCS_PwSgy5z6NDtGiLL-19792uaym8oWuxi66KYSfBXoCP50mh-9RnqYgPPWdkl0LPf9DpXA8cZZ9M-O-d0TkUxf40RGwwJiN3U72kiKki0QvvYBI9_PuIzRPcps1xqUmw-tHnaWNOarBfX_R4NKeNRDKMK-NXpXG9GwmXP9Ni63WiRpTsXP1KbY8AKWZOYqbIB1nXMWYZGkKNjfaccyIFATMrv6o0rNF8yXjHu6dbEft-qS2Yrx4LWjsaYtCTSfaeaWjW3ho3bmQYr' }}">
            </div>
            <div class="text-center md:text-left">
                <h2 class="font-headline-lg text-headline-lg text-on-background">{{ $product->name }}</h2>
                <p class="font-label-bold text-label-bold text-primary">{{ $product->category->name ?? 'Koleksi Terbatas Summer Sparkle' }}</p>
            </div>
        </div>

        <form action="#" method="POST">
            @csrf
            <!-- Rating Section -->
            <section class="mb-10 text-center">
                <label class="font-headline-lg text-headline-lg mb-6 block text-on-background">Seberapa Suka Kamu? 💕</label>
                <div class="flex justify-center gap-2 md:gap-4">
                    @for($i=1; $i<=5; $i++)
                    <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" class="hidden peer">
                    <label for="star{{ $i }}" class="group p-2 cursor-pointer hover:scale-110 transition-transform active:scale-95 text-surface-variant peer-checked:text-secondary-container">
                        <span class="material-symbols-outlined text-6xl drop-shadow-[4px_4px_0px_rgba(27,28,28,1)]" style="font-variation-settings: 'FILL' 1;">star</span>
                    </label>
                    @endfor
                </div>
            </section>

            <!-- Comment Form -->
            <section class="space-y-6">
                <div>
                    <label class="font-label-bold text-label-bold mb-3 block text-on-surface">Ceritakan pengalamanmu...</label>
                    <textarea name="comment" class="w-full h-40 border-4 border-on-background bg-white p-6 rounded-2xl font-body-md focus:ring-4 focus:ring-tertiary-container focus:outline-none placeholder:text-outline-variant shadow-inner" placeholder="Wah, produk ini imut banget! Aku suka detailnya..."></textarea>
                </div>
                
                <!-- Upload Section -->
                <div class="flex flex-wrap gap-4 items-center">
                    <label class="flex flex-col items-center justify-center w-32 h-32 border-4 border-dashed border-on-background rounded-2xl bg-surface-container hover:bg-surface-variant transition-colors group cursor-pointer">
                        <span class="material-symbols-outlined text-4xl text-primary group-hover:scale-125 transition-transform">photo_camera</span>
                        <span class="font-label-bold text-[10px] mt-2">Tambah Foto</span>
                        <input type="file" name="photo" class="hidden">
                    </label>
                    <div class="text-sm font-label-bold text-on-surface-variant max-w-[200px]">
                        Ayo tunjukkan fotomu yang paling estetik! ✨
                    </div>
                </div>

                <!-- Footer Action & Message -->
                <div class="pt-6 border-t-4 border-on-background border-dashed mt-10">
                    <button type="submit" class="w-full py-6 bg-primary text-on-primary font-headline-lg text-headline-lg rounded-2xl border-4 border-on-background shadow-[0px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:shadow-[0px_4px_0px_0px_rgba(27,28,28,1)] active:translate-y-2 active:shadow-none transition-all flex items-center justify-center gap-3">
                        Kirim Ulasan 💖
                    </button>
                    <div class="mt-6 flex items-center justify-center gap-2 bg-secondary-fixed/30 p-3 rounded-lg border-2 border-on-background/10">
                        <span class="material-symbols-outlined text-secondary text-sm">info</span>
                        <p class="text-xs font-body-md text-on-surface-variant">Ulasanmu akan dimoderasi sebelum tampil.</p>
                    </div>
                </div>
            </section>
        </form>
    </div>
</main>
@endsection