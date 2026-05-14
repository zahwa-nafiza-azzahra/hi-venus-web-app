<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Admin Dashboard | Hi Venus')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;800;900&family=Be+Vietnam+Pro:wght@400;500;600;700&family=Rubik:wght@400;700&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @include('components.page-animations')
</head>
<body class="bg-surface-bright text-on-surface font-body-md overflow-x-hidden animate-fade-in @yield('body_class')">
    <x-flash-messages />
    <!-- SideNavBar -->
    <nav class="fixed left-0 top-0 flex flex-col h-full z-40 h-screen w-72 border-r-4 border-on-background shadow-[6px_0px_0px_0px_rgba(27,28,28,1)] bg-surface-bright dark:bg-surface-dim">
        <!-- Header -->
        <div class="p-6 border-b-4 border-on-background bg-primary-fixed">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 rounded-full border-4 border-on-background bg-secondary-container overflow-hidden flex-shrink-0 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]">
                    <img alt="Admin Avatar" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCePED73LgEJ6Od9HSoQ26OxnEWDXG8PVDek50dd-WDQcYt-uRuSc4837SKq0boIoMc2Mczelj5pWBd8r25OWFFES1JjCO2lzvjx31sUTUVChTfRxXmA_2n6NOxzSjKXAYxSkNoxqmjzN95Ov_3UfqJB-xjfb9s7ratj3v_a5invqQrwtGGkE8ZB9sYYzAUAvPVq5gDEWCp2icaQgoscdlKmkdURdQnltXW1Z6z0ZtlKtRwCWw747NSLKv9GLj06mA1K7us8AB1UthN">
                </div>
                <div>
                    <h1 class="text-headline-lg font-headline-lg font-black text-primary leading-tight">Venus Admin</h1>
                    <p class="font-label-bold text-label-bold text-on-surface-variant">Store Manager</p>
                </div>
            </div>
        </div>
        <!-- Links -->
        <div class="flex-1 overflow-y-auto p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-secondary-container text-on-secondary-container border-4 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] scale-105' : 'text-on-surface dark:text-on-surface-variant hover:bg-surface-variant dark:hover:bg-surface-container-highest rounded-lg' }} font-bold flex items-center gap-3 p-4 transition-all">
                <span class="material-symbols-outlined text-2xl">home</span>
                <span class="font-label-bold text-label-bold">Home</span>
            </a>

            @if(auth()->user()->isAdmin())
            <div class="pt-4 pb-2 px-4 font-black text-[10px] uppercase tracking-widest text-on-surface-variant opacity-50">Admin Panel</div>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'bg-secondary-container text-on-secondary-container border-4 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] scale-105' : 'text-on-surface dark:text-on-surface-variant hover:bg-surface-variant dark:hover:bg-surface-container-highest rounded-lg' }} font-bold flex items-center gap-3 p-4 transition-all">
                <span class="material-symbols-outlined text-2xl">inventory_2</span>
                <span class="font-label-bold text-label-bold">Inventory</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index') ? 'bg-secondary-container text-on-secondary-container border-4 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] scale-105' : 'text-on-surface dark:text-on-surface-variant hover:bg-surface-variant dark:hover:bg-surface-container-highest rounded-lg' }} font-bold flex items-center gap-3 p-4 transition-all">
                <span class="material-symbols-outlined text-2xl">group</span>
                <span class="font-label-bold text-label-bold">Customers & Staff</span>
            </a>
            <a href="{{ route('pos.index') }}" class="{{ request()->routeIs('pos.index') ? 'bg-secondary-container text-on-secondary-container border-4 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] scale-105' : 'text-on-surface dark:text-on-surface-variant hover:bg-surface-variant dark:hover:bg-surface-container-highest rounded-lg' }} font-bold flex items-center gap-3 p-4 transition-all">
                <span class="material-symbols-outlined text-2xl">point_of_sale</span>
                <span class="font-label-bold text-label-bold">POS Kasir</span>
            </a>
            @endif

            <div class="pt-4 pb-2 px-4 font-black text-[10px] uppercase tracking-widest text-on-surface-variant opacity-50">My Account</div>
            <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'bg-secondary-container text-on-secondary-container border-4 border-on-background rounded-lg shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] scale-105' : 'text-on-surface dark:text-on-surface-variant hover:bg-surface-variant dark:hover:bg-surface-container-highest rounded-lg' }} font-bold flex items-center gap-3 p-4 transition-all">
                <span class="material-symbols-outlined text-2xl">settings</span>
                <span class="font-label-bold text-label-bold">Settings</span>
            </a>
        </div>
        <!-- CTA -->
        <div class="p-6 border-t-4 border-on-background bg-surface-container-low space-y-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-surface-bright text-error border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] rounded-full py-3 font-label-bold text-label-bold hover:bg-error hover:text-on-error hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] active:shadow-none transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">logout</span>
                    Logout
                </button>
            </form>
        </div>
    </nav>
    <!-- Main Content -->
    <main class="ml-72 min-h-screen relative pb-section-gap">
        <!-- Background Pattern Layer -->
        <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.4] bg-[repeating-linear-gradient(45deg,#ffd8eb_0px,#ffd8eb_40px,transparent_40px,transparent_80px,#ffe173_80px,#ffe173_120px,transparent_120px,transparent_160px)]"></div>
        <div class="relative z-10 p-margin-desktop">
            @yield('content')
        </div>
    </main>


    @stack('scripts')
</body>
</html>
