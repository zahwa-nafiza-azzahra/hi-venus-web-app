@extends('layouts.cashier')

@section('title', 'Cetak Struk | Hi Venus')
@section('page_title', 'Cetak Struk Transaksi')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fade-in">
    <!-- Kolom Kiri: Daftar Pesanan Lunas -->
    <div class="lg:col-span-1 space-y-6 no-print">
        <div class="bg-surface-container-low border-4 border-on-background p-6 rounded-xl shadow-[6px_6px_0px_0px_rgba(27,28,28,1)]">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-4">Daftar Transaksi</h2>
            <p class="text-sm text-on-surface-variant mb-6">Pilih pesanan yang ingin dicetak struknya.</p>
            
            <div class="space-y-4 max-h-[600px] overflow-y-auto pr-2">
                @forelse($paidOrders as $o)
                    <a href="{{ route('cashier.receipt', ['order_id' => $o->id]) }}" class="block p-4 border-4 {{ request('order_id') == $o->id ? 'border-primary bg-primary-container text-on-primary-container' : 'border-on-background bg-white hover:-translate-y-1 hover:shadow-[4px_4px_0px_0px_rgba(27,28,28,1)]' }} rounded-xl transition-all">
                        <div class="flex justify-between items-start mb-2">
                            <span class="font-label-bold text-label-bold uppercase">{{ $o->order_number }}</span>
                            <span class="text-xs font-bold opacity-70">{{ $o->created_at->format('d/m/y H:i') }}</span>
                        </div>
                        <div class="font-medium mb-1 truncate">{{ $o->recipient_name ?? $o->user->name }}</div>
                        <div class="flex justify-between items-center">
                            <span class="font-price-display text-primary text-sm">Rp {{ number_format($o->total_amount, 0, ',', '.') }}</span>
                            <span class="text-xs bg-surface-variant px-2 py-1 rounded">{{ $o->status_label }}</span>
                        </div>
                    </a>
                @empty
                    <div class="p-4 border-2 border-dashed border-on-background rounded-xl text-center text-on-surface-variant">
                        Belum ada pesanan lunas.
                    </div>
                @endforelse
            </div>
            
            <div class="mt-4">
                {{ $paidOrders->links() }}
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Struk -->
    <div class="lg:col-span-2">
        @if($selectedOrder)
            <main class="flex flex-col items-center justify-center relative w-full">
                <!-- Success Header -->
                <div class="text-center mb-8 z-10 no-print">
                    <div class="inline-flex items-center justify-center bg-secondary-container border-4 border-on-background rounded-full p-4 shadow-[4px_4px_0px_0px_rgba(27,28,28,1)] mb-4 transform -rotate-3">
                        <span class="material-symbols-outlined text-4xl text-on-secondary-fixed" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    </div>
                    <h1 class="font-headline-lg text-headline-lg text-primary mb-2">Transaksi Dipilih ✨</h1>
                    <p class="font-body text-sm text-on-surface-variant">Struk belanja siap untuk dicetak atau disimpan.</p>
                </div>

                <!-- Digital Receipt Bento/Card -->
                <div class="w-full max-w-xl bg-white border-4 border-on-background rounded-lg shadow-[12px_12px_0px_0px_rgba(27,28,28,1)] overflow-hidden relative mb-8" id="receipt-card">
                    <!-- Decorative Zig-Zag Edge Top -->
                    <div class="absolute top-0 left-0 w-full h-4 bg-primary flex overflow-hidden">
                        <div class="w-full h-full" style="background-image: radial-gradient(circle at 10px -5px, transparent 12px, #1b1c1c 13px);"></div>
                    </div>
                    
                    <div class="p-8 pt-12">
                        <!-- Receipt Header -->
                        <div class="flex flex-col items-center mb-8 border-b-4 border-dashed border-outline-variant pb-6">
                            <div class="font-headline-lg text-headline-lg text-primary italic font-black mb-1">Hi Venus</div>
                            <p class="font-label-bold text-label-bold text-on-surface-variant uppercase tracking-widest text-xs">Station 01 • Kawaii Boutique</p>
                            <p class="text-[12px] font-bold opacity-60 mt-1">{{ $selectedOrder->created_at->format('d M Y | H:i') }} WIB</p>
                            <p class="text-[12px] font-bold opacity-60 mt-1">No: {{ $selectedOrder->order_number }}</p>
                            <p class="text-[12px] font-bold opacity-60 mt-1">Plg: {{ $selectedOrder->recipient_name ?? $selectedOrder->user->name }}</p>
                        </div>

                        <!-- Receipt Items -->
                        <div class="space-y-6 mb-8">
                            @foreach($selectedOrder->items as $item)
                            <div class="flex justify-between items-start">
                                <div class="flex gap-4">
                                    <div>
                                        <p class="font-label-bold text-label-bold">{{ $item->product->name }}</p>
                                        @if($item->variant)
                                        <p class="text-xs text-on-surface-variant mt-0.5">Var: {{ $item->variant->size }} | {{ $item->variant->color }}</p>
                                        @endif
                                        <p class="text-on-surface-variant font-medium text-sm mt-1">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <p class="font-price-display text-price-display text-lg">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                            @endforeach
                        </div>

                        <!-- Total Section -->
                        <div class="bg-surface-container-low border-4 border-on-background p-6 rounded-xl relative">
                            <div class="flex justify-between items-center mb-2">
                                <p class="font-label-bold text-label-bold">Subtotal</p>
                                <p class="font-price-display text-price-display text-lg">Rp {{ number_format($selectedOrder->items->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}</p>
                            </div>
                            @if($selectedOrder->discount_amount > 0)
                            <div class="flex justify-between items-center mb-2 text-error">
                                <p class="font-label-bold text-label-bold">Diskon</p>
                                <p class="font-price-display text-price-display text-lg">- Rp {{ number_format($selectedOrder->discount_amount, 0, ',', '.') }}</p>
                            </div>
                            @endif
                            <div class="flex justify-between items-center mb-4 text-on-surface-variant border-b-2 border-dotted border-outline pb-4">
                                <p class="font-label-bold text-label-bold">Ongkos Kirim</p>
                                <p class="font-price-display text-price-display text-lg">Rp {{ number_format($selectedOrder->shipping_cost, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="font-headline-lg text-headline-lg text-primary italic">TOTAL</p>
                                <p class="font-headline-xl text-headline-xl text-primary">Rp {{ number_format($selectedOrder->total_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <!-- Footer Receipt -->
                        <div class="mt-8 text-center">
                            <div class="inline-block border-2 border-on-background px-6 py-2 rounded-lg bg-surface-variant font-label-bold text-on-surface mb-4 uppercase tracking-widest text-xs">
                                Metode: {{ strtoupper($selectedOrder->payment_method ?: 'TIDAK DIKETAHUI') }} ✅
                            </div>
                            <p class="text-on-surface-variant italic font-bold">Terima kasih sudah berbelanja, Kawaii-friends! ✨</p>
                        </div>
                    </div>

                    <!-- Bottom Zig-Zag Edge -->
                    <div class="h-4 bg-on-background w-full" style="clip-path: polygon(0 0, 5% 100%, 10% 0, 15% 100%, 20% 0, 25% 100%, 30% 0, 35% 100%, 40% 0, 45% 100%, 50% 0, 55% 100%, 60% 0, 65% 100%, 70% 0, 75% 100%, 80% 0, 85% 100%, 90% 0, 95% 100%, 100% 0);"></div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col md:flex-row gap-4 w-full justify-center md:w-auto no-print">
                    <button onclick="window.print()" class="bg-primary text-on-primary font-headline-lg text-headline-lg px-8 py-4 rounded-xl border-4 border-on-background shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none active:scale-95 transition-all flex items-center justify-center gap-3">
                        <span class="material-symbols-outlined text-3xl">print</span>
                        Cetak Struk
                    </button>
                    <!-- Download PDF -->
                    @if(Route::has('cashier.orders.pdf'))
                    <a href="{{ route('cashier.orders.pdf', $selectedOrder->id) }}" class="bg-secondary-container text-on-secondary-fixed font-headline-lg text-headline-lg px-8 py-4 rounded-xl border-4 border-on-background shadow-[6px_6px_0px_0px_rgba(27,28,28,1)] hover:translate-y-1 hover:translate-x-1 hover:shadow-none active:scale-95 transition-all flex items-center justify-center gap-3">
                        <span class="material-symbols-outlined text-3xl">picture_as_pdf</span>
                        Simpan PDF
                    </a>
                    @endif
                </div>
            </main>
        @else
            <div class="h-full min-h-[400px] flex flex-col items-center justify-center bg-surface-container-low border-4 border-dashed border-on-background rounded-xl p-8 text-center no-print">
                <span class="material-symbols-outlined text-[80px] text-on-surface-variant opacity-30 mb-4">receipt_long</span>
                <h3 class="font-headline-lg text-headline-lg text-on-surface-variant">Belum Ada Struk yang Dipilih</h3>
                <p class="mt-2 text-on-surface-variant opacity-70 max-w-md">Silakan pilih salah satu transaksi dari daftar di sebelah kiri untuk melihat dan mencetak struk belanjanya.</p>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    @media print {
        aside, nav, header, .no-print {
            display: none !important;
        }
        main, .lg\:col-span-2 {
            padding: 0 !important;
            margin: 0 auto !important;
            width: 100% !important;
        }
        body {
            background: white !important;
        }
        .md\:pl-64 {
            padding-left: 0 !important;
        }
        #receipt-card {
            box-shadow: none !important;
            border: 2px solid black !important;
            margin: 0 auto !important;
            max-width: 100% !important;
        }
    }
</style>
@endpush
@endsection
