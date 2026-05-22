@extends('layouts.app')

@section('title', 'Checkout | Hi Venus')

@section('body_class', 'kawaii-pattern')

@push('styles')
<style>
    .kawaii-pattern {
        background-color: #fcf9f8;
        background-image: radial-gradient(#ffd8eb 2px, transparent 2px);
        background-size: 32px 32px;
    }
    .comic-border { border: 4px solid #1b1c1c; }
    .comic-shadow { box-shadow: 8px 8px 0px 0px rgba(27,28,28,1); }
    .sticker-rotate-left { transform: rotate(-3deg); }
    .sticker-rotate-right { transform: rotate(3deg); }
</style>
@endpush

@section('content')
<main class="max-w-7xl mx-auto px-margin-mobile md:px-margin-desktop py-12">
    <div class="flex flex-col lg:grid lg:grid-cols-12 gap-gutter">
        <!-- Left Column: Checkout Details -->
        <div class="lg:col-span-8 space-y-10 animate-fade-in-left">
            <!-- Section: Shipping Address -->
            <section>
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-primary text-3xl">location_on</span>
                    <h2 class="font-headline-lg text-headline-lg text-primary italic">Alamat Pengiriman</h2>
                </div>
                <div class="bg-surface-container-lowest border-4 border-on-background p-6 rounded-none shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] relative overflow-hidden">
                    <div class="absolute -top-4 -right-4 w-16 h-16 bg-secondary border-4 border-on-background rounded-full flex items-center justify-center sticker-rotate-right animate-float">
                        <span class="material-symbols-outlined text-on-secondary">home</span>
                    </div>
                    <div class="space-y-2">
                        <p class="font-label-bold text-label-bold text-primary">Rumah (Utama)</p>
                        <h3 class="font-headline-lg text-2xl font-black">{{ auth()->user()->name }} (+62 {{ auth()->user()->phone ?? '812-3456-7890' }})</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant max-w-md">
                            Jl. Kawaii No. 88, Blok Bintang Lucu, Kec. Ceria, Kota Jakarta Selatan, DKI Jakarta, 12345
                        </p>
                    </div>
                    <button class="mt-6 px-6 py-2 bg-surface-container-high border-4 border-on-background font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] hover:scale-105 active:translate-y-1 active:shadow-none transition-all">
                        Ubah Alamat
                    </button>
                </div>
            </section>

            <!-- Section: Items Summary -->
            <section>
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-primary text-3xl">shopping_bag</span>
                    <h2 class="font-headline-lg text-headline-lg text-primary italic">Pesanan Kamu</h2>
                </div>
                <div class="space-y-4">
                    @php $total = 0; @endphp
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity']; @endphp
                        <div class="bg-white border-4 border-on-background p-4 flex items-center gap-4 shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] group">
                            <div class="w-24 h-24 bg-primary-fixed border-2 border-on-background rounded-xl flex-shrink-0 overflow-hidden sticker-rotate-left group-hover:rotate-0 transition-transform">
                                <img src="{{ (str_starts_with($details['image'] ?? '', 'http') ? $details['image'] : asset('storage/' . ($details['image'] ?? ''))) }}" onerror="this.src='https://lh3.googleusercontent.com/aida-public/AB6AXuC7hQjMKr-I4FiKO77l686kTHlpVcH8GQGJMApwkJc5f7bS8CVt3xu4ljvs55Aac3uJMbXQtM9PFEQdzsdzGahpu9LyYuowv745FNFLthLAMITi7VSPz7Dshmst7kJjpnUvPAktI9cCOKX6kb8cN6INxLBVbXKFQEP9zrpothTQaSA3D_aCQtixtdaozNG5GSUrQwkVsly4DGGPWTgJcYOX3cKBqt0HOTN19awWewwuoPwOPjcH0JKoqoyOSKym0u9OHnhleKG73wmx'"/>
                            </div>
                            <div class="flex-grow">
                                <h4 class="font-headline-lg text-xl font-extrabold text-on-background">{{ $details['name'] }}</h4>
                                <p class="font-body-md text-body-md text-on-surface-variant">Varian: Default</p>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="font-body-lg text-body-lg">{{ $details['quantity'] }}x</span>
                                    <span class="font-price-display text-price-display text-primary">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </section>

            <!-- Section: Shipping & Payment -->
            <div class="grid md:grid-cols-2 gap-gutter">
                <!-- Shipping -->
                <section class="space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-3xl">local_shipping</span>
                        <h2 class="font-headline-lg text-headline-lg text-primary italic">Ekspedisi</h2>
                    </div>
                    <div class="relative">
                        <select id="shipping-select" class="w-full h-16 px-6 bg-white border-4 border-on-background rounded-none font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] appearance-none focus:ring-0 focus:border-tertiary-container transition-all">
                            <option value="pickup">Ambil di Toko (Pickup) - Rp 0</option>
                            <option value="jnt" selected>J&T Express - Rp 15.000 (1-3 Hari)</option>
                            <option value="jne">JNE Reguler - Rp 18.000 (2-4 Hari)</option>
                            <option value="sicepat">SiCepat Halu - Rp 12.000 (3-5 Hari)</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
                    </div>
                </section>
                <!-- Payment -->
                <section class="space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-3xl">payments</span>
                        <h2 class="font-headline-lg text-headline-lg text-primary italic">Metode Bayar</h2>
                    </div>
                    <div class="space-y-3">
                        <label class="flex items-center p-4 bg-white border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] cursor-pointer hover:bg-surface-container transition-all">
                            <input checked class="w-6 h-6 border-4 border-on-background text-primary focus:ring-0" name="payment_option" value="Bank Transfer" type="radio"/>
                            <span class="ml-4 font-label-bold text-label-bold">Transfer Bank</span>
                        </label>
                        <label class="flex items-center p-4 bg-white border-4 border-on-background shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] cursor-pointer hover:bg-surface-container transition-all">
                            <input class="w-6 h-6 border-4 border-on-background text-primary focus:ring-0" name="payment_option" value="E-Wallet" type="radio"/>
                            <span class="ml-4 font-label-bold text-label-bold">E-Wallet (OVO/Dana)</span>
                        </label>
                    </div>
                </section>
            </div>
        </div>

        <!-- Right Column: Order Summary & Voucher -->
        <div class="lg:col-span-4 space-y-gutter animate-fade-in-right">
            <div class="bg-surface-container border-4 border-on-background p-8 rounded-none shadow-[10px_10px_0px_0px_rgba(27,28,28,1)] sticky top-28">
                <h2 class="font-headline-lg text-headline-lg text-on-background mb-6 flex items-center gap-2">
                    Ringkasan <span class="material-symbols-outlined text-primary">receipt_long</span>
                </h2>
                <!-- Voucher Input -->
                <div class="mb-8">
                    <label class="font-label-bold text-label-bold block mb-2">Punya Kode Voucher?</label>
                    @if(session('voucher'))
                        <div class="flex items-center justify-between bg-tertiary-container border-2 border-on-background p-3 rounded-lg shadow-sm">
                            <div>
                                <span class="font-bold text-tertiary">🎟️ {{ session('voucher')->code }}</span>
                                <p class="text-xs text-on-tertiary-container mt-1">Voucher berhasil dipakai!</p>
                            </div>
                            <form action="{{ route('checkout.remove_voucher') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-error hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('checkout.apply_voucher') }}" method="POST" class="flex gap-2">
                            @csrf
                            <input name="code" class="flex-grow bg-white border-4 border-on-background px-4 py-2 font-body-md focus:ring-0 focus:border-tertiary-container shadow-inner" placeholder="Masukkan Kode" type="text" required/>
                            <button type="submit" class="bg-secondary-container border-4 border-on-background px-4 font-label-bold text-label-bold shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] active:translate-y-1 active:shadow-none transition-all">
                                Pakai
                            </button>
                        </form>
                    @endif
                </div>
                <!-- Price Details -->
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between font-body-lg text-body-lg">
                        <span class="text-on-surface-variant">Total Produk</span>
                        <span class="font-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between font-body-lg text-body-lg">
                        <span class="text-on-surface-variant">Ongkos Kirim</span>
                        <span class="font-bold" id="shipping-cost-display">Rp 15.000</span>
                    </div>
                    @if(session('voucher'))
                        <div class="flex justify-between font-body-lg text-body-lg text-tertiary">
                            <span>Diskon Voucher</span>
                            <span class="font-bold" id="discount-display">- Rp 0</span>
                        </div>
                    @endif
                    <hr class="border-t-4 border-on-background border-dashed"/>
                    <div class="flex justify-between items-center">
                        <span class="font-headline-lg text-xl italic text-primary">Total Bayar</span>
                        <div class="relative">
                            <span class="font-price-display text-3xl font-black text-on-background" id="final-total-display">Rp {{ number_format($total + 15000, 0, ',', '.') }}</span>
                            <div class="absolute -top-6 -right-6 w-12 h-12 bg-secondary-container border-2 border-on-background rounded-full flex items-center justify-center animate-bounce">
                                <span class="material-symbols-outlined text-on-secondary-container text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Final Button -->
                <form action="{{ route('checkout.place_order') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment" id="selected_payment" value="Bank Transfer">
                    <input type="hidden" name="shipping" id="selected_shipping" value="jnt">
                    <button type="submit" class="w-full py-5 bg-primary text-on-primary border-4 border-on-background font-headline-lg text-2xl shadow-[8px_8px_0px_0px_rgba(27,28,28,1)] hover:scale-[1.02] active:translate-y-2 active:shadow-none transition-all flex items-center justify-center gap-3">
                        Konfirmasi & Bayar ✨
                    </button>
                </form>
                <p class="text-center font-body-md text-xs mt-6 text-on-surface-variant italic">
                    Dengan membayar, kamu setuju dengan syarat & ketentuan super imut kami!
                </p>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const shippingSelect = document.getElementById('shipping-select');
        const paymentRadios = document.querySelectorAll('input[name="payment_option"]');
        const selectedPaymentInput = document.getElementById('selected_payment');
        const selectedShippingInput = document.getElementById('selected_shipping');
        const shippingCostDisplay = document.getElementById('shipping-cost-display');
        const discountDisplay = document.getElementById('discount-display');
        const finalTotalDisplay = document.getElementById('final-total-display');
        
        const cartTotal = {{ $total }};
        const voucherType = "{{ session('voucher') ? session('voucher')->type : '' }}";
        const voucherValue = {{ session('voucher') ? session('voucher')->value : 0 }};
        
        function updateTotals() {
            let shippingCost = 15000;
            if (shippingSelect.value === 'pickup') shippingCost = 0;
            else if (shippingSelect.value === 'jne') shippingCost = 18000;
            else if (shippingSelect.value === 'sicepat') shippingCost = 12000;
            
            shippingCostDisplay.textContent = 'Rp ' + shippingCost.toLocaleString('id-ID');
            selectedShippingInput.value = shippingSelect.value;
            
            let discount = 0;
            if (voucherType === 'percentage') {
                discount = cartTotal * (voucherValue / 100);
            } else if (voucherType === 'fixed') {
                discount = voucherValue;
            } else if (voucherType === 'free_shipping') {
                discount = shippingCost;
            }
            
            if (discount > cartTotal + shippingCost) {
                discount = cartTotal + shippingCost;
            }
            
            if (discountDisplay) {
                discountDisplay.textContent = '- Rp ' + discount.toLocaleString('id-ID');
            }
            
            const finalTotal = (cartTotal + shippingCost) - discount;
            finalTotalDisplay.textContent = 'Rp ' + finalTotal.toLocaleString('id-ID');
        }

        if(shippingSelect) {
            shippingSelect.addEventListener('change', updateTotals);
        }
        
        paymentRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if(this.checked) {
                    selectedPaymentInput.value = this.value;
                }
            });
        });

        // initial call
        if(shippingSelect) updateTotals();
    });
</script>
@endpush
