@extends('layouts.cashier')

@section('title', 'Verifikasi Pickup | Hi Venus')
@section('page_title', 'Verifikasi Pickup Online')

@section('content')
<div class="animate-fade-in">
    <!-- Search Section -->
    <section class="mb-10">
        <div class="bg-surface-container-low border-4 border-on-background p-8 rounded-xl shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] relative overflow-hidden">
            <!-- Decorative Sparkles -->
            <span class="material-symbols-outlined absolute top-2 right-2 text-primary opacity-20 text-4xl">auto_awesome</span>
            <span class="material-symbols-outlined absolute bottom-2 left-2 text-tertiary opacity-20 text-4xl">star</span>
            
            <label class="block font-label-bold text-label-bold mb-4 text-on-surface-variant tracking-widest">INPUT KODE PICKUP / NOMOR PESANAN</label>
            <div class="flex flex-col md:flex-row gap-6">
                <div class="relative flex-1">
                    <input class="w-full bg-white border-4 border-on-background p-5 rounded-xl text-headline-lg-mobile font-headline-lg-mobile focus:ring-4 focus:ring-tertiary-container focus:outline-none placeholder:opacity-30" placeholder="Contoh: VENUS-XXXXX" type="text" value="VENUS-99283"/>
                    <span class="absolute right-5 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant text-4xl">qr_code_scanner</span>
                </div>
                <button class="bg-tertiary-container text-on-tertiary-fixed font-black px-10 py-5 border-4 border-on-background shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] rounded-xl hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-3xl">search</span>
                    CARI PESANAN
                </button>
            </div>
        </div>
    </section>

    <!-- Result Grid (Bento Style) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Order Status & Customer -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Status Card -->
            <div class="bg-white border-4 border-on-background p-8 rounded-xl shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] flex items-center justify-between">
                <div>
                    <p class="text-on-surface-variant font-label-bold text-label-bold tracking-widest">STATUS PESANAN</p>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="w-5 h-5 bg-secondary-container rounded-full border-4 border-on-background animate-pulse"></span>
                        <h3 class="font-headline-lg-mobile text-headline-lg-mobile text-secondary italic">Menunggu Pickup</h3>
                    </div>
                </div>
                <div class="rotate-3 bg-primary-fixed border-4 border-on-background px-4 py-2 rounded-full text-on-primary-fixed-variant font-black text-sm shadow-sm">
                    KILAT EXPRESS 🚀
                </div>
            </div>

            <!-- Details Card -->
            <div class="bg-white border-4 border-on-background p-10 rounded-xl shadow-[12px_12px_0px_0px_rgba(27,28,28,1)] relative">
                <h4 class="font-headline-lg text-headline-lg mb-8 border-b-4 border-surface-variant pb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">shopping_bag</span>
                    Detail Isi Pesanan
                </h4>
                <div class="space-y-8">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-surface-container-low/50 p-4 rounded-xl border-2 border-dashed border-on-background">
                        <span class="text-on-surface-variant font-label-bold text-label-bold uppercase">PELANGGAN</span>
                        <span class="font-headline-lg-mobile text-headline-lg-mobile text-primary italic font-black">Anya Forger ★</span>
                    </div>

                    <div class="space-y-6">
                        <span class="text-on-surface-variant font-label-bold text-label-bold block mb-4 uppercase tracking-widest">DAFTAR BARANG</span>
                        
                        <!-- Item 1 -->
                        <div class="flex items-center gap-6 p-6 bg-white border-4 border-on-background rounded-2xl hover:rotate-1 transition-transform">
                            <div class="w-20 h-20 bg-primary-fixed border-4 border-on-background rounded-xl flex items-center justify-center overflow-hidden rotate-3">
                                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuADMRVWhVfsnUHIVaX7cgnFYgsVZsvUnU_k5QEdXb8M6khlq3JZvDkDOvTFzWy3RJs88ZCstMPyHKX34aZIqZfMaI6h5YHlCZDuCDGnr8aKm0HicQ9J4v-mpfA9lfcA_Swbd394npU5Gz3sG7IO9dfgh5UmSnoK332dKQM3GXTLrVkDnpM8XSsrdJNAM1H8CNqx8NSV84xERK-AXql2dujyb2sauj7Z8qGzmgYFsoGyTgjjVZCHWxJRnyq_ly8uySotJ8fhDaKRRNGZ"/>
                            </div>
                            <div class="flex-1">
                                <p class="font-headline-lg text-xl italic">Retro Pink Sunglasses</p>
                                <p class="text-on-surface-variant font-bold">Qty: 1 • Rp 150.000</p>
                            </div>
                            <span class="font-price-display text-price-display text-primary">Rp 150k</span>
                        </div>

                        <!-- Item 2 -->
                        <div class="flex items-center gap-6 p-6 bg-white border-4 border-on-background rounded-2xl hover:-rotate-1 transition-transform">
                            <div class="w-20 h-20 bg-secondary-container border-4 border-on-background rounded-xl flex items-center justify-center overflow-hidden -rotate-3">
                                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxrDBPKDavtcRRsLOH2PiR8Uz423UsGENkCbzoGNXRjh8gPMBUxtAyD9Afcame3YbzraAGO-dSalCyPdHewxcZ610NAbk8A64s2BnmCwjPriihJaEXHYLRZgnNbiBZokKxWFh_RKARLNowQowZ0DAG5X1YyByKj7cGmb09ldMV-MmQRPLQ4i9KlWrUY15j_aJW22nNiKNG4fNpDpPYm4qdSQxVdNSPsWD44caM051N-ICe-DqgyE1UXj3q2GUt_6Ggewk1yKDxFyyo"/>
                            </div>
                            <div class="flex-1">
                                <p class="font-headline-lg text-xl italic">Strawberry Plushie XL</p>
                                <p class="text-on-surface-variant font-bold">Qty: 2 • Rp 85.000</p>
                            </div>
                            <span class="font-price-display text-price-display text-primary">Rp 170k</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Summary & CTA -->
        <div class="space-y-8">
            <!-- Total Card -->
            <div class="bg-secondary-container border-4 border-on-background p-8 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] text-on-secondary-fixed">
                <p class="font-label-bold text-label-bold opacity-70 tracking-widest">TOTAL TAGIHAN</p>
                <h2 class="font-headline-xl text-5xl italic mt-2">Rp 320.000</h2>
                <div class="mt-6 pt-6 border-t-4 border-on-secondary-fixed-variant border-dashed">
                    <p class="flex justify-between font-bold"><span>Subtotal</span> <span>Rp 320.000</span></p>
                    <p class="flex justify-between font-bold text-xs mt-2 opacity-70"><span>PPN (0%)</span> <span>Rp 0</span></p>
                </div>
            </div>

            <!-- Action Card -->
            <div class="bg-white border-4 border-on-background p-8 rounded-xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] text-center">
                <div class="mb-8 rotate-6 inline-block bg-surface-variant border-4 border-on-background p-6 rounded-2xl shadow-sm">
                    <span class="material-symbols-outlined text-6xl text-primary" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                </div>
                <p class="text-on-surface-variant mb-8 font-bold leading-relaxed">Pastikan semua barang sudah sesuai sebelum konfirmasi serah terima.</p>
                <button class="w-full py-8 bg-primary text-on-primary font-black text-2xl border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] rounded-2xl hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all active:scale-95">
                    KONFIRMASI PICKUP 💖
                </button>
                <button class="w-full py-4 mt-6 bg-white text-error font-bold border-4 border-error rounded-xl hover:bg-error-container transition-colors">
                    Batalkan Sesi
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
