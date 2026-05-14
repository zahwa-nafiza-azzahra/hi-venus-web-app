@extends('layouts.cashier')

@section('title', 'Cetak Struk | Hi Venus')
@section('page_title', 'Cetak Struk Transaksi')

@section('content')
<main class="flex flex-col items-center justify-center relative max-w-4xl mx-auto w-full animate-fade-in">
    <!-- Success Header -->
    <div class="text-center mb-10 z-10">
        <div class="inline-flex items-center justify-center bg-secondary-container border-4 border-on-background rounded-full p-6 shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] mb-6 transform -rotate-3">
            <span class="material-symbols-outlined text-[64px] text-on-secondary-fixed" style="font-variation-settings: 'FILL' 1;">check_circle</span>
        </div>
        <h1 class="font-headline-xl text-headline-xl text-primary mb-2">Transaksi Berhasil! ✨</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant">Struk belanja siap untuk dicetak atau disimpan.</p>
    </div>

    <!-- Digital Receipt Bento/Card -->
    <div class="w-full bg-white border-4 border-on-background rounded-lg shadow-[12px_12px_0px_0px_rgba(27,28,28,1)] overflow-hidden relative mb-12">
        <!-- Decorative Zig-Zag Edge Top -->
        <div class="absolute top-0 left-0 w-full h-4 bg-primary flex overflow-hidden">
            <div class="w-full h-full" style="background-image: radial-gradient(circle at 10px -5px, transparent 12px, #1b1c1c 13px);"></div>
        </div>
        
        <div class="p-8 pt-12">
            <!-- Receipt Header -->
            <div class="flex flex-col items-center mb-8 border-b-4 border-dashed border-outline-variant pb-6">
                <div class="font-headline-lg text-headline-lg text-primary italic font-black mb-1">Hi Venus</div>
                <p class="font-label-bold text-label-bold text-on-surface-variant uppercase tracking-widest text-xs">Station 01 • Kawaii Boutique</p>
                <p class="text-[12px] font-bold opacity-60 mt-1">{{ now()->format('d M Y | H:i') }} WIB</p>
            </div>

            <!-- Receipt Items -->
            <div class="space-y-6 mb-8">
                <div class="flex justify-between items-start">
                    <div class="flex gap-4">
                        <div class="w-16 h-16 bg-primary-fixed border-2 border-on-background rounded-xl flex items-center justify-center overflow-hidden rotate-2">
                            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBPZNstcZDDt_IeOBmJfa5pk6jn4hgG88XzfEb2IO8gArTjqqLxNMKU8_lAkRMvNA9qj9bwhDy2vzA087jHJklCBEQvqB2e2JsYiXbset5FU5sNQsB5b1IXsavDbRWk1oK4O48jueqcQ3hj5VZhbGSAjqQ5MeCULfulNTl1Ay73yhywtMtSTH4OxAOlOQOdAyuAvdrCBfzQw1TC7y0tn7I-RnxozV2ptD2G2zqs1VQcqXMfksMIi0xp0lqhfXzDvpNHbaw_FTO1DUD5"/>
                        </div>
                        <div>
                            <p class="font-label-bold text-label-bold">Kacamata Bintang Pink</p>
                            <p class="text-on-surface-variant font-medium text-sm">1 x Rp 150.000</p>
                        </div>
                    </div>
                    <p class="font-price-display text-price-display text-lg">Rp 150.000</p>
                </div>
                <div class="flex justify-between items-start">
                    <div class="flex gap-4">
                        <div class="w-16 h-16 bg-secondary-fixed border-2 border-on-background rounded-xl flex items-center justify-center overflow-hidden -rotate-2">
                            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBvbS3y05OnkTR8Yid-eSJ9UJRKU6srXn-cz5jMDDkh9nPGdPZ5BVGFLHeIeemoT8cOV1fLhksAMLmI6uRUS21_dJXWXI7xrXnSPPTVHwavT8kq-QelyA7GU76oaDDgqKZLNng6RzKMOzyIsc-ASgj0kmrt8b1FTwqP0TSZoq9Gyv7kMZssCSisdwBAs_2mFOA0P6DCLNHEfwjiwGAmv72-NuyhzbnFCgqfeAJqtCGwDqt5M0oqx5ciQP-kIHPQXAhw_fFaVkCJIpUc"/>
                        </div>
                        <div>
                            <p class="font-label-bold text-label-bold">Tas Mini Turkuis</p>
                            <p class="text-on-surface-variant font-medium text-sm">2 x Rp 225.000</p>
                        </div>
                    </div>
                    <p class="font-price-display text-price-display text-lg">Rp 450.000</p>
                </div>
            </div>

            <!-- Total Section -->
            <div class="bg-surface-container-low border-4 border-on-background p-6 rounded-xl relative">
                <!-- Sparkle Sticker -->
                <div class="absolute -top-4 -right-4 rotate-12">
                    <div class="bg-tertiary-container text-on-tertiary border-2 border-on-background px-3 py-1 rounded-full font-label-bold text-sm shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]">
                        BEST BUY!
                    </div>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <p class="font-label-bold text-label-bold">Subtotal</p>
                    <p class="font-price-display text-price-display text-lg">Rp 600.000</p>
                </div>
                <div class="flex justify-between items-center mb-4 text-on-surface-variant border-b-2 border-dotted border-outline pb-4">
                    <p class="font-label-bold text-label-bold">Pajak (11%)</p>
                    <p class="font-price-display text-price-display text-lg">Rp 66.000</p>
                </div>
                <div class="flex justify-between items-center">
                    <p class="font-headline-lg text-headline-lg text-primary italic">TOTAL</p>
                    <p class="font-headline-xl text-headline-xl text-primary">Rp 666.000</p>
                </div>
            </div>

            <!-- Footer Receipt -->
            <div class="mt-8 text-center">
                <div class="inline-block border-2 border-on-background px-6 py-2 rounded-lg bg-surface-variant font-label-bold text-on-surface mb-4 uppercase tracking-widest text-xs">
                    Metode: QRIS BERHASIL ✅
                </div>
                <p class="text-on-surface-variant italic font-bold">Terima kasih sudah berbelanja, Kawaii-friends! ✨</p>
            </div>
        </div>

        <!-- Bottom Zig-Zag Edge -->
        <div class="h-4 bg-on-background w-full" style="clip-path: polygon(0 0, 5% 100%, 10% 0, 15% 100%, 20% 0, 25% 100%, 30% 0, 35% 100%, 40% 0, 45% 100%, 50% 0, 55% 100%, 60% 0, 65% 100%, 70% 0, 75% 100%, 80% 0, 85% 100%, 90% 0, 95% 100%, 100% 0);"></div>
    </div>

    <!-- Actions -->
    <div class="flex flex-col md:flex-row gap-6 w-full md:w-auto">
        <button onclick="window.print()" class="bg-primary text-on-primary font-headline-lg text-headline-lg px-12 py-6 rounded-xl border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none active:scale-95 transition-all flex items-center justify-center gap-4">
            <span class="material-symbols-outlined text-4xl">print</span>
            Cetak Struk
        </button>
        <button class="bg-secondary-container text-on-secondary-fixed font-headline-lg text-headline-lg px-10 py-6 rounded-xl border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none active:scale-95 transition-all flex items-center justify-center gap-4">
            <span class="material-symbols-outlined text-4xl">picture_as_pdf</span>
            Simpan PDF
        </button>
    </div>

    <!-- Secondary Action Link -->
    <a href="{{ route('cashier.index') }}" class="mt-12 font-black text-primary underline underline-offset-8 decoration-4 hover:text-on-primary-fixed-variant transition-colors uppercase tracking-widest text-sm">
        Kembali ke Menu Utama
    </a>
</main>

@push('styles')
<style>
    @media print {
        aside, nav, header, .no-print {
            display: none !important;
        }
        main {
            padding: 0 !important;
            margin: 0 !important;
        }
        body {
            background: white !important;
        }
        .md\:pl-64 {
            padding-left: 0 !important;
        }
    }
</style>
@endpush
@endsection
