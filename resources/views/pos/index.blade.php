@extends($layout)

@section('title', 'POS Kasir | Hi Venus')

@section('content')
    <div
        class="flex flex-col h-auto md:h-[calc(100vh-140px)] -m-4 md:-m-margin-desktop overflow-visible md:p-5">
        <div
            class="flex-1 grid grid-cols-1 md:grid-cols-12 overflow-visible md:overflow-hidden max-w-none w-full bg-surface-bright border-4 border-on-background rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] min-h-screen md:min-h-0">

            {{-- Left: Product Search & Grid --}}
            <section
                class="md:col-span-7 flex flex-col bg-surface-bright border-b-4 md:border-b-0 md:border-r-4 border-on-background p-6 overflow-visible md:overflow-hidden relative animate-fade-in-left">
                {{-- Search & Filters --}}
                <div class="flex flex-col gap-6 mb-6">
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-6 top-1/2 -translate-y-1/2 text-primary text-3xl animate-pulse">search</span>
                        <input type="text" placeholder="Search products or scan..."
                            class="w-full bg-surface-container-lowest border-4 border-on-background rounded-full pl-16 pr-4 py-3 font-body-md text-body-md shadow-[inset_0px_4px_0px_0px_rgba(0,0,0,0.05)] focus:border-tertiary-container focus:ring-0 outline-none input-animate">
                    </div>
                    <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide stagger-container">
                        @foreach(['All Items', 'Dresses', 'Tops', 'Extras', 'Shoes'] as $cat)
                            <button
                                class="{{ $cat == 'All Items' ? 'bg-primary text-on-primary' : 'bg-surface-bright text-on-background' }} border-4 border-on-background rounded-full px-8 py-2 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all whitespace-nowrap">
                                {{ $cat }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Product Grid --}}
                <div class="flex-1 overflow-y-visible md:overflow-y-auto pr-2 grid grid-cols-2 lg:grid-cols-4 gap-6 pb-6 stagger-container">
                    @php
                        $posProducts = [
                            ['name' => 'Bunny Plushie', 'price' => '24.00', 'color' => 'bg-tertiary-fixed', 'icon' => 'cruelty_free'],
                            ['name' => 'Star Clips', 'price' => '12.00', 'color' => 'bg-secondary-fixed', 'icon' => 'stars'],
                            ['name' => 'Sweet Tote', 'price' => '35.00', 'color' => 'bg-primary-fixed', 'icon' => 'icecream'],
                            ['name' => 'Heart Stickers', 'price' => '5.00', 'color' => 'bg-surface-variant', 'icon' => 'favorite'],
                            ['name' => 'Sparkle Wand', 'price' => '18.00', 'color' => 'bg-secondary-container', 'icon' => 'magic_button'],
                            ['name' => 'Moon Lamp', 'price' => '42.00', 'color' => 'bg-tertiary-container', 'icon' => 'brightness_3'],
                            ['name' => 'Kawaii Pins', 'price' => '8.00', 'color' => 'bg-primary-container', 'icon' => 'push_pin'],
                            ['name' => 'Puffy Pillow', 'price' => '28.00', 'color' => 'bg-surface-variant', 'icon' => 'weekend'],
                        ];
                    @endphp
                    @foreach($posProducts as $p)
                        <div
                            class="bg-surface-bright border-4 border-on-background rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all p-4 flex flex-col items-center text-center group cursor-pointer active:scale-95">
                            <div
                                class="aspect-square w-full rounded-xl overflow-hidden mb-3 {{ $p['color'] }} border-4 border-on-background flex items-center justify-center bg-[radial-gradient(#ffffff_2px,transparent_2px)] [background-size:12px_12px]">
                                <span
                                    class="material-symbols-outlined text-5xl text-on-background group-hover:scale-125 transition-transform"
                                    style="font-variation-settings: 'FILL' 1;">{{ $p['icon'] }}</span>
                            </div>
                            <p class="font-bold text-on-background italic line-clamp-1 mb-1">{{ $p['name'] }}</p>
                            <p class="font-price-display text-price-display text-primary text-sm">${{ $p['price'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Right: Cart & Checkout (Live Bag) --}}
            <section
                class="md:col-span-5 flex flex-col bg-surface-container-low p-8 overflow-visible md:overflow-hidden animate-fade-in-right">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="font-headline-lg text-headline-lg font-black italic animate-bounce">Live Bag</h2>
                    <button
                        class="bg-surface-bright text-error border-4 border-error rounded-lg px-4 py-2 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_#ba1a1a] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_#ba1a1a] transition-all flex items-center gap-2">
                        <span
                            class="material-symbols-outlined">delete_sweep</span>
                        Clear
                    </button>
                </div>

                {{-- Cart Items --}}
                <div class="flex-1 overflow-y-visible md:overflow-y-auto space-y-4 mb-8 pr-2 stagger-container">
                    @php
                        $cartPos = [
                            ['name' => 'Bunny Plushie', 'price' => '24.00', 'qty' => 1, 'color' => 'bg-tertiary-fixed', 'icon' => 'cruelty_free'],
                            ['name' => 'Star Clips', 'price' => '12.00', 'qty' => 2, 'color' => 'bg-secondary-fixed', 'icon' => 'stars'],
                        ];
                    @endphp
                    @foreach($cartPos as $item)
                        <div
                            class="bg-surface-bright border-4 border-on-background rounded-xl shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] p-4 flex items-center gap-4 group">
                            <div
                                class="w-16 h-16 {{ $item['color'] }} border-4 border-on-background rounded-xl flex items-center justify-center shrink-0 group-hover:rotate-6 transition-transform">
                                <span
                                    class="material-symbols-outlined text-3xl text-on-background group-hover:scale-110 transition-transform"
                                    style="font-variation-settings: 'FILL' 1;">{{ $item['icon'] }}</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-bold italic text-on-background truncate">{{ $item['name'] }}</p>
                                <p class="text-xl font-price-display text-primary">${{ $item['price'] }}</p>
                            </div>
                            <div class="flex items-center gap-4 shrink-0">
                                <button
                                    class="w-10 h-10 bg-surface-bright text-on-background border-4 border-on-background rounded-full font-label-bold text-label-bold shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] hover:translate-y-0.5 hover:translate-x-0.5 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all flex items-center justify-center">-</button>
                                <span class="font-bold text-xl w-6 text-center italic">{{ $item['qty'] }}</span>
                                <button
                                    class="w-10 h-10 bg-primary text-on-primary border-4 border-on-background rounded-full font-label-bold text-label-bold shadow-[2px_2px_0px_0px_rgba(27,28,28,1)] hover:translate-y-0.5 hover:translate-x-0.5 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all flex items-center justify-center">+</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Summary & Checkout --}}
                <div class="mt-auto flex flex-col gap-8">
                    <div
                        class="bg-surface-bright border-4 border-on-background rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] p-8 animate-scale-in">
                        <div class="flex flex-col gap-3 mb-6">
                            <div class="flex justify-between font-bold text-on-surface-variant italic">
                                <span>Subtotal</span><span>$48.00</span></div>
                            <div class="flex justify-between font-bold text-on-surface-variant italic"><span>Tax
                                    (11%)</span><span>$5.28</span></div>
                            <div class="flex justify-between font-black text-primary italic animate-pulse">
                                <span>Discount</span><span>-$2.00</span></div>
                        </div>
                        <div class="pt-6 border-t-4 border-dashed border-on-background flex justify-between items-end">
                            <span class="font-headline-lg text-headline-lg font-black italic">Total Pay</span>
                            <span
                                class="font-price-display text-price-display text-primary text-5xl leading-none">$51.28</span>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4">
                        <a href="{{ route('cashier.receipt') }}"
                            class="w-full bg-primary text-on-primary border-4 border-on-background rounded-lg py-4 font-headline-lg-mobile text-headline-lg-mobile shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all flex items-center justify-center gap-2 animate-glow">
                            <span class="material-symbols-outlined text-4xl">payments</span> Let's Checkout!
                        </a>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('cashier.receipt') }}"
                                class="bg-secondary text-on-secondary border-4 border-on-background rounded-lg py-3 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">print</span> Print
                            </a>
                            <button
                                class="bg-tertiary text-on-tertiary border-4 border-on-background rounded-lg py-3 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-[0px_0px_0px_0px_rgba(27,28,28,1)] transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">mail</span> Email
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection