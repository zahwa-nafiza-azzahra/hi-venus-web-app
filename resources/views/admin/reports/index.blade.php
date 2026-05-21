@extends('layouts.admin')

@section('title', 'Sales Reports | Hi Venus')

@push('styles')
    <style>
        .kawaii-card {
            background: white;
            border: 4px solid #1b1c1c;
            box-shadow: 8px 8px 0px 0px #1b1c1c;
            transition: transform 0.2s ease;
        }

        .wonky-border {
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
        }

        .press-effect:active {
            transform: translate(4px, 4px);
            box-shadow: 0px 0px 0px 0px #1b1c1c !important;
        }

        .sticker-rotate-left { transform: rotate(-2deg); }
        .sticker-rotate-right { transform: rotate(2deg); }

        ::-webkit-scrollbar { width: 12px; }
        ::-webkit-scrollbar-track { background: #f0eded; border-left: 3px solid #1b1c1c; }
        ::-webkit-scrollbar-thumb { background: #a52a80; border: 3px solid #1b1c1c; border-radius: 10px; }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                "primary": "#a52a80",
                "primary-container": "#ff76ce",
                "on-primary-container": "#760059",
                "secondary": "#5f6132",
                "secondary-container": "#e1e4a9",
                "on-secondary-container": "#636636",
                "tertiary": "#006c52",
                "tertiary-container": "#94FFD8",
                "on-tertiary-container": "#004534",
                "surface": "#fcf9f8",
                "surface-container": "#f0eded",
                "on-surface": "#161d1f",
                "on-surface-variant": "#54414b",
                "outline": "#87717c",
                "background": "#fcf9f8",
                "error": "#ba1a1a",
                "error-container": "#ffdad6"
              },
              "borderRadius": {
                "DEFAULT": "1.5rem",
                "lg": "2.5rem",
                "xl": "4rem",
                "full": "9999px"
              },
              "fontFamily": {
                "display": ["Comfortaa"],
                "headline-lg": ["Comfortaa"],
                "body-md": ["Quicksand"],
                "body-lg": ["Quicksand"],
                "label-caps": ["Quicksand"]
              },
              "fontSize": {
                "display": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                "headline-lg": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "500"}],
                "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "600"}],
                "label-caps": ["12px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "700"}]
              }
            },
          },
        }
    </script>
@endpush

@section('content')
<div class="animate-fade-in font-body-md text-on-surface min-h-screen relative">
<!-- Header & Filters -->
<section class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
<div>
<h2 class="font-display text-display text-on-surface">Sales Reports 📈</h2>
<p class="font-body-lg text-on-surface-variant">Real-time vibes of your store performance.</p>
</div>
<div class="flex flex-wrap items-center gap-4">
<!-- Period Filter -->
<div class="flex border-4 border-on-surface rounded-2xl bg-white overflow-hidden shadow-[4px_4px_0px_0px_#1b1c1c]">
<a href="?period=daily" class="px-6 py-2 {{ $period == 'daily' ? 'bg-secondary-container' : 'hover:bg-surface-container' }} font-bold border-r-4 border-on-surface">Daily</a>
<a href="?period=weekly" class="px-6 py-2 {{ $period == 'weekly' ? 'bg-secondary-container' : 'hover:bg-surface-container' }} font-bold border-r-4 border-on-surface">Weekly</a>
<a href="?period=monthly" class="px-6 py-2 {{ $period == 'monthly' ? 'bg-secondary-container' : 'hover:bg-surface-container' }} font-bold">Monthly</a>
</div>
<!-- Export Buttons -->
<div class="flex gap-4">
<button class="bg-tertiary-container text-on-tertiary-container border-4 border-on-surface px-6 py-2 rounded-2xl font-bold shadow-[4px_4px_0px_0px_#1b1c1c] press-effect flex items-center gap-2">
<span class="material-symbols-outlined" data-icon="download">download</span> PDF
                    </button>
<button class="bg-primary-container text-on-primary-container border-4 border-on-surface px-6 py-2 rounded-2xl font-bold shadow-[4px_4px_0px_0px_#1b1c1c] press-effect flex items-center gap-2">
<span class="material-symbols-outlined" data-icon="table_view">table_view</span> Excel
                    </button>
</div>
</div>
</section>
<!-- Summary Cards -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
<!-- Card 1 -->
<div class="kawaii-card p-8 rounded-lg sticker-rotate-left relative group flex-1">
<div class="flex justify-between items-start mb-6">
<div class="p-3 bg-primary-container/20 border-4 border-on-surface rounded-2xl">
<span class="material-symbols-outlined text-primary" data-icon="payments">payments</span>
</div>
<span class="bg-secondary-container px-3 py-1 rounded-full border-2 border-on-surface font-bold text-xs">+12.4%</span>
</div>
<p class="font-label-caps text-outline uppercase text-xs mb-1">Total Revenue</p>
<h3 class="font-display text-headline-lg">${{ number_format($totalRevenue, 2) }}</h3>
</div>
<!-- Card 2 -->
<div class="kawaii-card p-8 rounded-lg relative group flex-1">
<div class="flex justify-between items-start mb-6">
<div class="p-3 bg-tertiary-container/30 border-4 border-on-surface rounded-2xl">
<span class="material-symbols-outlined text-tertiary" data-icon="receipt_long">receipt_long</span>
</div>
<span class="bg-secondary-container px-3 py-1 rounded-full border-2 border-on-surface font-bold text-xs">+5.2%</span>
</div>
<p class="font-label-caps text-outline uppercase text-xs mb-1">Total Transactions</p>
<h3 class="font-display text-headline-lg">{{ number_format($totalTransactions) }}</h3>
</div>
<!-- Card 3 -->
<div class="kawaii-card p-8 rounded-lg sticker-rotate-right relative group flex-1">
<div class="flex justify-between items-start mb-6">
<div class="p-3 bg-secondary-container/30 border-4 border-on-surface rounded-2xl">
<span class="material-symbols-outlined text-secondary" data-icon="ads_click">ads_click</span>
</div>
<span class="bg-error-container text-error px-3 py-1 rounded-full border-2 border-on-surface font-bold text-xs">-1.1%</span>
</div>
<p class="font-label-caps text-outline uppercase text-xs mb-1">Conversion Rate</p>
<h3 class="font-display text-headline-lg">{{ $conversionRate }}%</h3>
</div>
</section>
<!-- Chart Section -->
<section class="kawaii-card p-10 rounded-lg relative mb-10">
<div class="absolute -top-6 right-10 sticker-rotate-right bg-secondary-container border-4 border-on-surface px-4 py-2 rounded-xl font-display text-sm z-10 shadow-[4px_4px_0px_0px_#1b1c1c]">
                LIT TRENDS! 🔥
            </div>
<div class="flex justify-between items-end mb-10">
<div>
<h4 class="font-display text-headline-lg">Sales Trends</h4>
<p class="font-body-md text-outline">Monitoring the peak hype hours.</p>
</div>
<div class="flex gap-4">
<div class="flex items-center gap-2">
<span class="w-4 h-4 rounded-full bg-primary border-2 border-on-surface"></span>
<span class="font-bold text-xs">Revenue</span>
</div>
<div class="flex items-center gap-2">
<span class="w-4 h-4 rounded-full bg-tertiary-container border-2 border-on-surface"></span>
<span class="font-bold text-xs">Orders</span>
</div>
</div>
</div>
<div class="h-64 flex items-end justify-between gap-6 border-b-8 border-l-8 border-on-surface p-6 bg-surface-container rounded-bl-3xl">
@foreach($trends as $day => $data)
<div class="flex-1 flex flex-col items-center gap-3 group cursor-pointer h-full justify-end">
<div class="w-full bg-[{{ $loop->iteration % 2 == 0 ? '#ff76ce' : '#94FFD8' }}] border-4 border-on-surface rounded-t-xl transition-all duration-300 group-hover:scale-y-110 group-hover:-translate-y-2 origin-bottom" style="height: {{ $data['revenue'] }}%;"></div>
<span class="font-bold text-xs mt-auto">{{ $day }}</span>
</div>
@endforeach
</div>
</section>
<!-- Columns Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
<!-- Best Selling Products -->
<section class="kawaii-card p-8 rounded-lg">
<div class="flex justify-between items-center mb-8">
<h4 class="font-display text-headline-lg">Best Selling 💎</h4>
<button class="font-bold text-primary underline underline-offset-8 decoration-4 decoration-primary/30 hover:decoration-primary transition-all">View All</button>
</div>
<div class="space-y-6">
@foreach($topProducts as $product)
<!-- Product Item -->
<div class="flex items-center gap-6 p-4 border-4 border-on-surface rounded-3xl hover:bg-surface-container transition-colors cursor-pointer group">
<div class="w-20 h-20 border-4 border-on-surface rounded-2xl {{ $loop->even ? 'sticker-rotate-left' : 'sticker-rotate-right' }} overflow-hidden bg-white group-hover:scale-110 transition-transform flex-shrink-0">
<img class="w-full h-full object-cover" data-alt="{{ $product->name }}" src="{{ $product->image_url ?? 'https://via.placeholder.com/150' }}">
</div>
<div class="flex-1 min-w-0">
<p class="font-display text-xl text-on-surface truncate">{{ $product->name }}</p>
<p class="font-bold text-outline text-xs">{{ $product->order_items_count }} sold this period</p>
</div>
<div class="text-right flex-shrink-0">
<p class="font-display text-2xl text-primary">${{ number_format($product->price, 2) }}</p>
<span class="bg-{{ $loop->even ? 'surface' : 'secondary' }}-container px-3 py-1 rounded-full border-2 border-on-surface text-[10px] font-black shadow-[2px_2px_0px_0px_#1b1c1c]">TOP {{ $loop->iteration }}</span>
</div>
</div>
@endforeach
</div>
</section>
<!-- Recent Transactions -->
<section class="kawaii-card p-8 rounded-lg">
<div class="flex justify-between items-center mb-8">
<h4 class="font-display text-headline-lg">Recent History 🧾</h4>
</div>
<div class="overflow-x-auto">
<table class="w-full border-separate border-spacing-y-6">
<thead>
<tr class="text-left font-label-caps text-outline uppercase text-xs">
<th class="pb-2 px-4">Customer</th>
<th class="pb-2">Date</th>
<th class="pb-2">Amount</th>
<th class="pb-2 text-right">Status</th>
</tr>
</thead>
<tbody class="font-body-md">
@foreach($recentOrders as $order)
<tr class="bg-surface-container/40 border-4 border-on-surface rounded-2xl group hover:bg-white transition-colors cursor-pointer">
<td class="py-4 px-4 rounded-l-3xl border-y-4 border-l-4 border-on-surface py-6">
<span class="font-black truncate max-w-[100px] inline-block">{{ $order->user->name ?? 'Guest' }}</span>
</td>
<td class="py-4 border-y-4 border-on-surface text-xs font-bold py-6">{{ $order->created_at->diffForHumans() }}</td>
<td class="py-4 border-y-4 border-on-surface font-display text-lg py-6">${{ number_format($order->total_amount, 2) }}</td>
<td class="py-4 px-4 rounded-r-3xl border-y-4 border-r-4 border-on-surface text-right py-6">
<span class="bg-{{ $order->status == 'paid' ? 'tertiary' : 'secondary' }}-container px-3 py-1 rounded-xl border-2 border-on-surface text-[10px] font-black italic shadow-[2px_2px_0px_0px_#1b1c1c] uppercase">{{ $order->status }}</span>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</section>
</div>

<!-- Floating Decoration -->
<div class="fixed bottom-10 right-10 pointer-events-none select-none z-50">
<span class="material-symbols-outlined text-primary-container text-6xl animate-bounce drop-shadow-[4px_4px_0px_#1b1c1c]" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
</div>
</div>
@endsection
