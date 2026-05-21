<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kawaii POS | Hi Venus')</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Rubik:wght@400;500;700&family=Be+Vietnam+Pro:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    <!-- Scripts & Styles -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-variant": "#e5e2e1",
                        "surface-container": "#f0eded",
                        "surface-container-low": "#f6f3f2",
                        "secondary-container": "#fdd73b",
                        "primary": "#9e357b",
                        "on-secondary-fixed": "#221b00",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed": "#ffd8eb",
                        "on-secondary-fixed-variant": "#554500",
                        "on-tertiary-container": "#004860",
                        "on-secondary": "#ffffff",
                        "primary-fixed-dim": "#ffaedb",
                        "on-error-container": "#93000a",
                        "on-tertiary": "#ffffff",
                        "error": "#ba1a1a",
                        "on-tertiary-fixed": "#001e2b",
                        "tertiary": "#006687",
                        "on-surface-variant": "#53424b",
                        "on-background": "#1b1c1c",
                        "surface-tint": "#9e357b",
                        "on-tertiary-fixed-variant": "#004d66",
                        "on-primary": "#ffffff",
                        "on-primary-fixed-variant": "#811962",
                        "on-primary-container": "#7a135d",
                        "inverse-primary": "#ffaedb",
                        "surface-container-highest": "#e5e2e1",
                        "outline-variant": "#d8c0cb",
                        "tertiary-container": "#38bbef",
                        "background": "#fcf9f8",
                        "surface-bright": "#fcf9f8",
                        "secondary": "#705d00",
                        "on-primary-fixed": "#3c002b",
                        "error-container": "#ffdad6",
                        "outline": "#86727b",
                        "tertiary-fixed": "#c1e8ff",
                        "primary-container": "#ff85d0",
                        "inverse-on-surface": "#f3f0ef",
                        "on-error": "#ffffff",
                        "surface-container-high": "#eae7e7",
                        "secondary-fixed": "#ffe173",
                        "inverse-surface": "#303030",
                        "on-surface": "#1b1c1c",
                        "tertiary-fixed-dim": "#73d2ff",
                        "surface-dim": "#dcd9d9",
                        "secondary-fixed-dim": "#e8c426",
                        "surface": "#fcf9f8",
                        "on-secondary-container": "#715d00"
                    },
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "section-gap": "80px",
                        "unit": "8px",
                        "gutter": "24px",
                        "margin-mobile": "16px",
                        "margin-desktop": "64px"
                    },
                    "fontFamily": {
                        "headline-xl": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "label-bold": ["Rubik"],
                        "price-display": ["Plus Jakarta Sans"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "body-md": ["Be Vietnam Pro"],
                        "body-lg": ["Be Vietnam Pro"]
                    },
                    "fontSize": {
                        "headline-xl": ["48px", {"lineHeight": "56px", "letterSpacing": "-1px", "fontWeight": "800"}],
                        "headline-lg-mobile": ["28px", {"lineHeight": "36px", "fontWeight": "800"}],
                        "label-bold": ["14px", {"lineHeight": "20px", "fontWeight": "700"}],
                        "price-display": ["24px", {"lineHeight": "32px", "fontWeight": "800"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "800"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "500"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "600"}]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 48;
        }
        body {
            background-color: #fcf9f8;
            background-image: repeating-linear-gradient(45deg, #fcf9f8, #fcf9f8 20px, #f0eded 20px, #f0eded 40px);
            background-attachment: fixed;
        }
        .kawaii-border {
            border: 4px solid #1b1c1c;
        }
        .kawaii-shadow {
            box-shadow: 8px 8px 0px 0px rgba(27, 28, 28, 1);
        }
    </style>
    @stack('styles')
</head>
<body class="font-body-md text-on-background">
    <!-- Sidebar Navigation -->
    <aside class="hidden md:flex flex-col h-screen w-64 fixed left-0 top-0 bg-surface-container border-r-4 border-on-background shadow-[8px_0px_0px_0px_rgba(27,28,28,1)] z-50 py-margin-mobile">
        <div class="px-6 mb-8">
            <h1 class="font-headline-lg text-headline-lg font-black text-primary italic">Hi Venus</h1>
            <p class="text-on-surface-variant font-label-bold text-label-bold">Kasir Station</p>
        </div>
        <nav class="flex-1 space-y-2">
            <a class="flex items-center gap-3 p-4 m-2 rounded-xl transition-all hover:scale-105 active:scale-95 {{ request()->routeIs('pos.index') ? 'bg-secondary-container text-on-secondary-fixed font-bold border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]' : 'text-on-surface-variant hover:bg-surface-variant' }}" href="{{ route('pos.index') }}">
                <span class="material-symbols-outlined" {{ request()->routeIs('pos.index') ? "style=font-variation-settings:'FILL'1" : '' }}>point_of_sale</span>
                <span class="font-label-bold text-label-bold">Checkout / POS</span>
            </a>
            <a class="flex items-center gap-3 p-4 m-2 rounded-xl transition-all hover:scale-105 active:scale-95 {{ request()->routeIs('cashier.catalog') ? 'bg-secondary-container text-on-secondary-fixed font-bold border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]' : 'text-on-surface-variant hover:bg-surface-variant' }}" href="{{ route('cashier.catalog') }}">
                <span class="material-symbols-outlined" {{ request()->routeIs('cashier.catalog') ? "style=font-variation-settings:'FILL'1" : '' }}>inventory_2</span>
                <span class="font-label-bold text-label-bold">Katalog & Stok</span>
            </a>
            <a class="flex items-center gap-3 p-4 m-2 rounded-xl transition-all hover:scale-105 active:scale-95 {{ request()->routeIs('cashier.pickup') ? 'bg-secondary-container text-on-secondary-fixed font-bold border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]' : 'text-on-surface-variant hover:bg-surface-variant' }}" href="{{ route('cashier.pickup') }}">
                <span class="material-symbols-outlined" {{ request()->routeIs('cashier.pickup') ? "style=font-variation-settings:'FILL'1" : '' }}>local_shipping</span>
                <span class="font-label-bold text-label-bold">Pickup Online</span>
            </a>
            <a class="flex items-center gap-3 p-4 m-2 rounded-xl transition-all hover:scale-105 active:scale-95 {{ request()->routeIs('cashier.receipt') ? 'bg-secondary-container text-on-secondary-fixed font-bold border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]' : 'text-on-surface-variant hover:bg-surface-variant' }}" href="{{ route('cashier.receipt') }}">
                <span class="material-symbols-outlined" {{ request()->routeIs('cashier.receipt') ? "style=font-variation-settings:'FILL'1" : '' }}>receipt_long</span>
                <span class="font-label-bold text-label-bold">Cetak Struk</span>
            </a>
            <a class="flex items-center gap-3 p-4 m-2 rounded-xl transition-all hover:scale-105 active:scale-95 {{ request()->routeIs('cashier.report') ? 'bg-secondary-container text-on-secondary-fixed font-bold border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]' : 'text-on-surface-variant hover:bg-surface-variant' }}" href="{{ route('cashier.report') }}">
                <span class="material-symbols-outlined" {{ request()->routeIs('cashier.report') ? "style=font-variation-settings:'FILL'1" : '' }}>analytics</span>
                <span class="font-label-bold text-label-bold">Laporan Shift</span>
            </a>
            <a class="flex items-center gap-3 p-4 m-2 rounded-xl transition-all hover:scale-105 active:scale-95 {{ request()->routeIs('cashier.index') ? 'bg-secondary-container text-on-secondary-fixed font-bold border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]' : 'text-on-surface-variant hover:bg-surface-variant' }}" href="{{ route('cashier.index') }}">
                <span class="material-symbols-outlined" {{ request()->routeIs('cashier.index') ? "style=font-variation-settings:'FILL'1" : '' }}>dashboard</span>
                <span class="font-label-bold text-label-bold">Dashboard</span>
            </a>
        </nav>
        <div class="p-4 border-t-4 border-on-background bg-surface-container-low mt-auto">
            <div class="flex items-center gap-3">
                <img alt="Cashier Profile" class="w-10 h-10 rounded-full border-2 border-on-background" src="{{ auth()->user()->avatar_url }}">
                <div>
                    <p class="font-label-bold text-label-bold">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-on-surface-variant">Role: {{ auth()->user()->role }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="w-full py-2 bg-error text-on-error font-bold border-2 border-on-background rounded-lg hover:scale-105 transition-all text-xs">
                    Logout Shift
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="md:pl-64">
        <!-- Top Nav -->
        <header class="w-full top-0 sticky bg-surface border-b-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] flex justify-between items-center px-gutter py-4 z-40">
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-primary md:hidden">menu</span>
                <h2 class="font-headline-lg text-headline-lg font-black text-primary italic">@yield('page_title', 'Kawaii POS')</h2>
            </div>
            <div class="flex items-center gap-4">
                <button class="material-symbols-outlined text-primary hover:scale-110 transition-transform">notifications</button>
                <button class="material-symbols-outlined text-primary hover:scale-110 transition-transform">settings</button>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-margin-mobile md:p-margin-desktop min-h-[calc(100vh-80px)]">
            @yield('content')
        </main>
    </div>

    <!-- Mobile Navigation (Bottom) -->
    <nav class="md:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 pb-4 pt-2 bg-surface-container-highest border-t-4 border-on-background shadow-[0px_-4px_0px_0px_rgba(27,28,28,1)] rounded-t-xl">
        <a class="flex flex-col items-center justify-center p-2 {{ request()->routeIs('pos.index') ? 'bg-primary-container text-on-primary-container border-2 border-on-background rounded-xl px-4 py-1 shadow-[2px_2px_0px_0px_rgba(27,28,28,1)]' : 'text-on-surface-variant' }}" href="{{ route('pos.index') }}">
            <span class="material-symbols-outlined">point_of_sale</span>
            <span class="font-label-bold text-[10px]">POS</span>
        </a>
        <a class="flex flex-col items-center justify-center p-2 {{ request()->routeIs('cashier.catalog') ? 'bg-primary-container text-on-primary-container border-2 border-on-background rounded-xl px-4 py-1 shadow-[2px_2px_0px_0px_rgba(27,28,28,1)]' : 'text-on-surface-variant' }}" href="{{ route('cashier.catalog') }}">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="font-label-bold text-[10px]">Stock</span>
        </a>
        <a class="flex flex-col items-center justify-center p-2 {{ request()->routeIs('cashier.pickup') ? 'bg-primary-container text-on-primary-container border-2 border-on-background rounded-xl px-4 py-1 shadow-[2px_2px_0px_0px_rgba(27,28,28,1)]' : 'text-on-surface-variant' }}" href="{{ route('cashier.pickup') }}">
            <span class="material-symbols-outlined">local_shipping</span>
            <span class="font-label-bold text-[10px]">Pickup</span>
        </a>
        <a class="flex flex-col items-center justify-center p-2 {{ request()->routeIs('cashier.report') ? 'bg-primary-container text-on-primary-container border-2 border-on-background rounded-xl px-4 py-1 shadow-[2px_2px_0px_0px_rgba(27,28,28,1)]' : 'text-on-surface-variant' }}" href="{{ route('cashier.report') }}">
            <span class="material-symbols-outlined">analytics</span>
            <span class="font-label-bold text-[10px]">Report</span>
        </a>
    </nav>

    @stack('scripts')
</body>
</html>
