@extends('layouts.admin')

@section('title', 'Discounts & Vouchers | Hi Venus')

@push('styles')
    <style>
        .wonky-border {
            border: 4px solid #1b1c1c;
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
        }
        
        .kawaii-card {
            background: white;
            border: 4px solid #1b1c1c;
            box-shadow: 8px 8px 0px 0px #1b1c1c;
        }

        .sticker-rotate-left { transform: rotate(-1deg); }
        .sticker-rotate-right { transform: rotate(1.5deg); }
        
        .btn-chunky {
            border: 4px solid #1b1c1c;
            box-shadow: 6px 6px 0px 0px #1b1c1c;
            transition: all 0.1s ease;
        }
        .btn-chunky:active {
            transform: translate(4px, 4px);
            box-shadow: 0px 0px 0px 0px #1b1c1c !important;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 12px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #fcf9f8;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #9e357b;
            border: 3px solid #1b1c1c;
            border-radius: 10px;
        }
    </style>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "primary": "#a52a80",
                    "on-primary": "#ffffff",
                    "primary-container": "#ff76ce",
                    "on-primary-container": "#760059",
                    "secondary": "#5f6132",
                    "on-secondary": "#ffffff",
                    "secondary-container": "#e1e4a9",
                    "on-secondary-container": "#636636",
                    "tertiary": "#006c52",
                    "on-tertiary": "#ffffff",
                    "tertiary-container": "#4cb996",
                    "on-tertiary-container": "#004534",
                    "error": "#ba1a1a",
                    "surface": "#fcf9f8",
                    "on-surface": "#161d1f",
                    "outline": "#87717c",
                    "surface-container": "#f0eded"
            },
            "borderRadius": {
                    "DEFAULT": "1.5rem",
                    "lg": "2.5rem",
                    "xl": "4rem",
                    "full": "9999px"
            },
            "fontFamily": {
                    "display": ["Comfortaa"],
                    "headline": ["Comfortaa"],
                    "body": ["Quicksand"]
            }
          },
        },
      }
    </script>
@endpush

@section('content')
<div class="animate-fade-in font-body text-on-surface custom-scrollbar selection:bg-primary-container selection:text-on-primary-container relative">
<!-- HEADER -->
<section class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
<div>
<h2 class="font-display text-5xl text-primary font-black flex items-center gap-4">
                    Discounts &amp; Vouchers
                    <span class="text-4xl animate-bounce">🎟️</span>
</h2>
<p class="font-body text-xl font-bold text-on-surface/60 mt-2">Manage your shop rewards and promotional campaigns</p>
</div>
<button class="btn-chunky px-8 py-5 bg-primary text-on-primary rounded-2xl font-display text-lg font-black flex items-center gap-3">
<span class="material-symbols-outlined text-3xl">add_circle</span>
                CREATE NEW VOUCHER
            </button>
</section>

<!-- SUMMARY CARDS -->
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
<div class="kawaii-card p-6 sticker-rotate-left bg-white">
<div class="flex justify-between items-start mb-6">
<div class="w-14 h-14 bg-secondary-container border-4 border-on-surface rounded-2xl flex items-center justify-center">
<span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">bolt</span>
</div>
<span class="bg-primary-container text-on-primary-container font-bold text-xs px-4 py-1 border-2 border-on-surface rounded-full shadow-[2px_2px_0px_0px_#1b1c1c]">LIVE</span>
</div>
<p class="font-body font-bold text-on-surface/50 uppercase text-xs tracking-widest">Active Vouchers</p>
<p class="font-display text-5xl font-black mt-2">{{ $totalActive }}</p>
</div>
<div class="kawaii-card p-6 sticker-rotate-right bg-white">
<div class="flex justify-between items-start mb-6">
<div class="w-14 h-14 bg-tertiary-container border-4 border-on-surface rounded-2xl flex items-center justify-center">
<span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">shopping_cart</span>
</div>
</div>
<p class="font-body font-bold text-on-surface/50 uppercase text-xs tracking-widest">Total Used</p>
<p class="font-display text-5xl font-black mt-2">{{ $totalUsed }}</p>
</div>
<div class="kawaii-card p-6 sticker-rotate-left bg-white">
<div class="flex justify-between items-start mb-6">
<div class="w-14 h-14 bg-primary-container border-4 border-on-surface rounded-2xl flex items-center justify-center">
<span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">payments</span>
</div>
</div>
<p class="font-body font-bold text-on-surface/50 uppercase text-xs tracking-widest">Total Discounted</p>
<p class="font-display text-5xl font-black mt-2">Rp {{ number_format($totalDiscounted, 0, ',', '.') }}</p>
</div>
<div class="kawaii-card p-6 sticker-rotate-right bg-white">
<div class="flex justify-between items-start mb-6">
<div class="w-14 h-14 bg-error-container border-4 border-on-surface rounded-2xl flex items-center justify-center">
<span class="material-symbols-outlined text-3xl text-error" style="font-variation-settings: 'FILL' 1;">timer</span>
</div>
</div>
<p class="font-body font-bold text-on-surface/50 uppercase text-xs tracking-widest">Expiring Soon</p>
<p class="font-display text-5xl font-black mt-2">{{ str_pad($expiringSoon, 2, '0', STR_PAD_LEFT) }}</p>
</div>
</section>

<!-- TABLE SECTION -->
<div class="kawaii-card rounded-3xl overflow-hidden bg-white">
<div class="p-8 border-b-4 border-on-surface flex flex-wrap gap-6 items-center justify-between bg-surface-container/30">
<div class="flex gap-4">
<div class="relative">
<select class="appearance-none bg-white border-4 border-on-surface rounded-2xl px-8 py-3 font-bold pr-16 focus:ring-4 focus:ring-primary-container shadow-[4px_4px_0px_0px_#1b1c1c] transition-all">
<option>All Types</option>
<option>Percentage</option>
<option>Fixed Amount</option>
<option>Free Shipping</option>
</select>
<span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
</div>
<div class="relative">
<select class="appearance-none bg-white border-4 border-on-surface rounded-2xl px-8 py-3 font-bold pr-16 focus:ring-4 focus:ring-primary-container shadow-[4px_4px_0px_0px_#1b1c1c] transition-all">
<option>Status: All</option>
<option>Active</option>
<option>Paused</option>
<option>Expired</option>
</select>
<span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">expand_more</span>
</div>
</div>
<div class="flex gap-4">
<button class="w-14 h-14 flex items-center justify-center bg-white border-4 border-on-surface rounded-2xl shadow-[4px_4px_0px_0px_#1b1c1c] hover:bg-secondary-container transition-all">
<span class="material-symbols-outlined text-2xl">download</span>
</button>
<button class="w-14 h-14 flex items-center justify-center bg-white border-4 border-on-surface rounded-2xl shadow-[4px_4px_0px_0px_#1b1c1c] hover:bg-secondary-container transition-all">
<span class="material-symbols-outlined text-2xl">refresh</span>
</button>
</div>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left">
<thead>
<tr class="bg-primary/5 border-b-4 border-on-surface">
<th class="p-6 font-display font-black text-xs uppercase tracking-widest">Voucher Code</th>
<th class="p-6 font-display font-black text-xs uppercase tracking-widest">Type</th>
<th class="p-6 font-display font-black text-xs uppercase tracking-widest">Value</th>
<th class="p-6 font-display font-black text-xs uppercase tracking-widest">Min Spend</th>
<th class="p-6 font-display font-black text-xs uppercase tracking-widest">Quota</th>
<th class="p-6 font-display font-black text-xs uppercase tracking-widest">Validity</th>
<th class="p-6 font-display font-black text-xs uppercase tracking-widest">Status</th>
<th class="p-6 font-display font-black text-xs uppercase tracking-widest text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y-4 divide-on-surface">
@forelse($vouchers as $voucher)
<tr class="hover:bg-primary-container/10 transition-colors">
<td class="p-6">
<span class="font-bold text-primary font-display text-lg">
                                    {{ $voucher->code }}
                                </span>
</td>
<td class="p-6">
@if($voucher->type == 'percentage')
<span class="bg-tertiary-container text-on-tertiary-container px-4 py-1 border-2 border-on-surface rounded-full font-bold text-xs">PERCENTAGE</span>
@elseif($voucher->type == 'free_shipping')
<span class="bg-secondary-container text-on-secondary-container px-4 py-1 border-2 border-on-surface rounded-full font-bold text-xs">FREE SHIPPING</span>
@else
<span class="bg-primary-container text-on-primary-container px-4 py-1 border-2 border-on-surface rounded-full font-bold text-xs">FIXED</span>
@endif
</td>
<td class="p-6 font-display text-2xl font-black">
    @if($voucher->type == 'percentage')
        {{ $voucher->value }}%
    @elseif($voucher->type == 'free_shipping')
        FREE
    @else
        Rp {{ number_format($voucher->value, 0, ',', '.') }}
    @endif
</td>
<td class="p-6 font-bold text-on-surface/60">Rp {{ number_format($voucher->min_spend, 0, ',', '.') }}</td>
<td class="p-6 font-bold text-on-surface/60">{{ $voucher->quota ? $voucher->quota_used . ' / ' . $voucher->quota : 'Unlimited' }}</td>
<td class="p-6">
<div class="font-bold text-sm leading-tight">
<p class="text-primary">START: {{ $voucher->start_date ? $voucher->start_date->format('d M y') : 'Now' }}</p>
<p class="opacity-50">END: {{ $voucher->end_date ? $voucher->end_date->format('d M y') : 'Ongoing' }}</p>
</div>
</td>
<td class="p-6">
<label class="relative inline-flex items-center cursor-pointer group">
<input {{ $voucher->is_active ? 'checked' : '' }} class="sr-only peer" type="checkbox"/>
<div class="w-16 h-10 bg-surface border-4 border-on-surface rounded-full peer peer-checked:after:translate-x-full peer-checked:after:content-['✨'] after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:border-2 after:border-on-surface after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-primary-container flex items-center justify-center"></div>
</label>
</td>
<td class="p-6">
<div class="flex justify-end gap-3">
<button class="w-12 h-12 border-4 border-on-surface bg-white rounded-xl shadow-[3px_3px_0px_0px_#1b1c1c] hover:translate-y-px hover:translate-x-px hover:shadow-none flex items-center justify-center text-primary transition-all">
<span class="material-symbols-outlined">edit</span>
</button>
<button class="w-12 h-12 border-4 border-on-surface bg-white rounded-xl shadow-[3px_3px_0px_0px_#1b1c1c] hover:translate-y-px hover:translate-x-px hover:shadow-none flex items-center justify-center text-error transition-all">
<span class="material-symbols-outlined">delete</span>
</button>
</div>
</td>
</tr>
@empty
<tr>
    <td colspan="8" class="p-10 text-center font-bold text-on-surface/50">
        No vouchers found. Create one to get started!
    </td>
</tr>
@endforelse
</tbody>
</table>
</div>
<div class="p-8 bg-surface-container/10 flex justify-between items-center border-t-4 border-on-surface">
<p class="font-bold text-on-surface/50">Showing {{ $vouchers->count() }} of {{ $vouchers->total() }} vouchers</p>
<div class="flex gap-4">
    {{ $vouchers->links('pagination::tailwind') }}
</div>
</div>
</div>
<!-- DECORATIVE ELEMENTS -->
<div class="fixed bottom-10 right-10 pointer-events-none opacity-40">
<span class="material-symbols-outlined text-[100px] text-primary-container absolute -top-12 -left-12 rotate-12">auto_awesome</span>
<span class="material-symbols-outlined text-[60px] text-tertiary-container absolute top-10 right-4 -rotate-12">favorite</span>
</div>
</div>
@endsection

@push('scripts')
<script>
        // Micro-interactions for table rows
        document.querySelectorAll('tr').forEach(row => {
            row.addEventListener('mouseenter', () => {
                row.style.transform = 'scale(1.005) translateX(8px)';
                row.style.transition = 'transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1)';
            });
            row.addEventListener('mouseleave', () => {
                row.style.transform = 'scale(1) translateX(0)';
            });
        });

        // Floating sparkles effect on buttons from SCREEN_20 logic
        document.querySelectorAll('.btn-chunky').forEach(btn => {
            btn.addEventListener('click', function(e) {
                for(let i=0; i<8; i++) {
                    const spark = document.createElement('span');
                    spark.className = 'material-symbols-outlined absolute pointer-events-none text-primary-container';
                    spark.textContent = 'sparkle';
                    spark.style.left = e.pageX - 20 + (Math.random() * 40) + 'px';
                    spark.style.top = e.pageY - 20 + (Math.random() * 40) + 'px';
                    spark.style.transition = 'all 0.6s cubic-bezier(0.19, 1, 0.22, 1)';
                    spark.style.fontSize = (16 + Math.random() * 24) + 'px';
                    spark.style.zIndex = '100';
                    document.body.appendChild(spark);
                    
                    setTimeout(() => {
                        spark.style.transform = `translate(${(Math.random()-0.5)*150}px, ${(Math.random()-0.5)*150}px) rotate(${Math.random()*360}deg) scale(0)`;
                        spark.style.opacity = '0';
                    }, 50);
                    
                    setTimeout(() => spark.remove(), 700);
                }
            });
        });
    </script>
@endpush
