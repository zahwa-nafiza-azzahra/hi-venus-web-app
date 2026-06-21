<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Hi Venus Boutique')</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&family=Rubik:wght@700&family=Be+Vietnam+Pro:wght@500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('components.page-animations')
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col overflow-x-hidden animate-fade-in @yield('body_class')">
    <x-flash-messages />

    {{-- ====== NAVBAR ====== --}}
    <nav class="bg-primary flex justify-between items-center px-margin-mobile md:px-margin-desktop py-4 w-full sticky top-0 z-50 border-b-4 border-on-background shadow-[0px_6px_0px_0px_rgba(27,28,28,1)]" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 20px, rgba(255,133,208,0.4) 20px, rgba(255,133,208,0.4) 40px);">
        <div class="flex items-center gap-8 bg-primary border-4 border-on-background px-6 py-2 rounded-full shadow-[4px_4px_0px_0px_#1b1c1c] rotate-1">
            <a href="{{ route('home') }}" class="text-headline-lg font-headline-lg font-black text-on-primary tracking-tighter italic hover:scale-105 transition-transform">Hi Venus</a>
            <div class="hidden md:flex gap-6">
                <a class="font-label-bold text-label-bold text-on-primary/90 hover:text-on-primary hover:scale-105 transition-transform {{ request()->routeIs('home') ? 'border-b-4 border-on-primary pb-1 !text-on-primary' : '' }}" href="{{ route('home') }}">Home</a>
                <a class="font-label-bold text-label-bold text-on-primary/90 hover:text-on-primary hover:scale-105 transition-transform {{ request()->routeIs('products.*') ? 'border-b-4 border-on-primary pb-1 !text-on-primary' : '' }}" href="{{ route('products.index') }}">Shop</a>
                <a class="font-label-bold text-label-bold text-on-primary/90 hover:text-on-primary hover:scale-105 transition-transform {{ request()->routeIs('products.new_arrivals') ? 'border-b-4 border-on-primary pb-1 !text-on-primary' : '' }}" href="{{ route('products.new_arrivals') }}">New Arrivals</a>
                <a class="font-label-bold text-label-bold text-on-primary/90 hover:text-on-primary hover:scale-105 transition-transform {{ request()->routeIs('products.best_sellers') ? 'border-b-4 border-on-primary pb-1 !text-on-primary' : '' }}" href="{{ route('products.best_sellers') }}">Best Sellers</a>
                @auth
                <a class="font-label-bold text-label-bold text-on-primary/90 hover:text-on-primary hover:scale-105 transition-transform {{ request()->routeIs('wishlist') ? 'border-b-4 border-on-primary pb-1 !text-on-primary' : '' }}" href="{{ route('wishlist') }}">Wishlist</a>
                @endauth
                <a class="font-label-bold text-label-bold text-on-primary/90 hover:text-on-primary hover:scale-105 transition-transform {{ request()->routeIs('about') ? 'border-b-4 border-on-primary pb-1 !text-on-primary' : '' }}" href="{{ route('about') }}">About Us</a>
            </div>
        </div>
        <div class="flex items-center gap-4 bg-primary border-4 border-on-background px-4 py-2 rounded-full shadow-[4px_4px_0px_0px_#1b1c1c] -rotate-1">
            @auth
            <a href="{{ route('cart.index') }}" class="relative text-on-primary/90 hover:text-on-primary hover:scale-105 transition-transform hover:shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] active:translate-y-1 active:shadow-none border-2 border-transparent hover:border-on-background rounded-full p-2 flex items-center justify-center">
                <span class="material-symbols-outlined" data-icon="shopping_basket">shopping_basket</span>
                <span class="absolute -top-2 -right-2 bg-secondary-fixed text-on-background font-label-bold text-[10px] w-5 h-5 rounded-full border-2 border-on-background flex items-center justify-center">
                    {{ count((array) session('cart')) }}
                </span>
            </a>
            @endauth
            @auth
                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="text-on-primary/90 hover:text-on-primary hover:scale-105 transition-transform hover:shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] active:translate-y-1 active:shadow-none border-2 border-transparent hover:border-on-background rounded-full p-2 flex items-center justify-center" title="Dashboard">
                    <span class="material-symbols-outlined" data-icon="space_dashboard">space_dashboard</span>
                </a>
                <a href="{{ route('settings') }}" class="text-on-primary/90 hover:text-on-primary hover:scale-105 transition-transform hover:shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] active:translate-y-1 active:shadow-none border-2 border-transparent hover:border-on-background rounded-full p-2 flex items-center justify-center" title="Profil">
                    <span class="material-symbols-outlined" data-icon="person">person</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-on-primary/90 hover:text-error hover:scale-110 transition-all hover:shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] active:translate-y-1 active:shadow-none border-2 border-transparent hover:border-on-background rounded-full p-2 flex items-center justify-center" title="Logout">
                        <span class="material-symbols-outlined">logout</span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-on-primary/90 hover:text-on-primary hover:scale-105 transition-transform hover:shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] active:translate-y-1 active:shadow-none border-2 border-transparent hover:border-on-background rounded-full p-2 flex items-center justify-center">
                    <span class="material-symbols-outlined" data-icon="login">login</span>
                </a>
            @endauth
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- ====== FOOTER ====== --}}
    <footer class="bg-primary flex flex-col md:flex-row flex-wrap justify-between items-start p-margin-mobile md:p-margin-desktop w-full border-t-4 border-on-background mt-section-gap z-20 relative" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 20px, rgba(255,133,208,0.4) 20px, rgba(255,133,208,0.4) 40px);">
        <div class="mb-8 md:mb-0 p-8 border-4 border-on-background shadow-[8px_8px_0px_0px_#1b1c1c] rounded-2xl -rotate-1" style="background-color: #ffffff !important; color: #1b1c1c !important;">
            <div class="text-headline-xl font-headline-xl font-black text-primary italic mb-4" style="color: #9e357b !important;">Hi Venus</div>
            <p class="font-body-md text-body-md max-w-sm font-bold italic" style="color: #1b1c1c !important;">Toko paling imut untuk segala kebutuhan aksesoris dan kebahagiaanmu! ✨</p>
        </div>
        
        <div class="grid grid-cols-2 gap-12 p-8 border-4 border-on-background shadow-[8px_8px_0px_0px_#1b1c1c] rounded-2xl rotate-1" style="background-color: #ffffff !important; color: #1b1c1c !important;">
            <div class="flex flex-col gap-3">
                <h4 class="font-headline-lg text-headline-lg text-primary italic" style="color: #9e357b !important;">Info</h4>
                <a class="font-body-md text-body-md font-bold hover:text-primary hover:rotate-2 transition-transform inline-block" style="color: #1b1c1c !important;" href="#">Privacy Policy</a>
                <a class="font-body-md text-body-md font-bold hover:text-primary hover:rotate-2 transition-transform inline-block" style="color: #1b1c1c !important;" href="#">Terms of Service</a>
            </div>
            <div class="flex flex-col gap-3">
                <h4 class="font-headline-lg text-headline-lg text-primary italic" style="color: #9e357b !important;">Bantuan</h4>
                <a class="font-body-md text-body-md font-bold hover:text-primary hover:rotate-2 transition-transform inline-block" style="color: #1b1c1c !important;" href="#">Shipping Info</a>
                <a class="font-body-md text-body-md font-bold hover:text-primary hover:rotate-2 transition-transform inline-block" style="color: #1b1c1c !important;" href="#">Contact Us</a>
            </div>
        </div>

    </footer>

    @stack('scripts')
</body>
</html>