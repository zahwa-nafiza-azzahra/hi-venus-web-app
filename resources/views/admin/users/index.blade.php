@extends('layouts.admin')

@section('title', 'Manage Customers | Hi Venus')

@push('styles')
<style>
    .sticker-rotate-left { transform: rotate(-3deg); }
    .sticker-rotate-right { transform: rotate(3deg); }
    
    .comic-border {
        border: 4px solid #000000 !important;
    }
    
    .comic-shadow {
        box-shadow: 8px 8px 0px 0px #000000 !important;
    }
    
    .comic-shadow-sm {
        box-shadow: 4px 4px 0px 0px #000000 !important;
    }
    
    .button-press:hover {
        transform: translate(2px, 2px);
        box-shadow: 4px 4px 0px 0px #000000 !important;
    }

    .stat-pill {
        background: #fff;
        border: 3px solid #000;
        border-radius: 9999px;
        padding: 6px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }
</style>
@endpush

@section('content')
<div class="animate-fade-in">
    <!-- Header Section (Perfectly Matching Search Bar) -->
    <header class="flex flex-col md:flex-row justify-end items-center mb-20 gap-8">
        <!-- Search Bar - Perfectly matched to cards (Rounding + Shadow) -->
        <form action="{{ route('admin.users.index') }}" method="GET" class="w-full md:w-80 relative group animate-fade-in-right">
            <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none z-10">
                <span class="material-symbols-outlined text-[#9e357b] font-black transition-transform text-2xl">search</span>
            </div>
            <input name="search" value="{{ request('search') }}" class="w-full pl-16 pr-6 py-4 bg-white border-4 border-black rounded-[40px] font-body-md text-xl comic-shadow focus:outline-none focus:border-[#ff00ff] focus:ring-0 transition-all placeholder-black/20" placeholder="Find by name/email/phone" type="text"/>
            @if(request('search'))
                <a href="{{ route('admin.users.index') }}" class="absolute inset-y-0 right-0 pr-6 flex items-center z-10 text-error hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined">close</span>
                </a>
            @endif
        </form>
    </header>

    <!-- 3-Column Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 stagger-container pb-20">
        @php
            $colors = ['bg-white', 'bg-[#ffc8dd]', 'bg-[#c1e8ff]', 'bg-secondary-container', 'bg-tertiary-container'];
        @endphp

        @forelse($users as $index => $user)
        <div class="{{ $colors[$index % count($colors)] }} comic-border comic-shadow p-8 rounded-[40px] relative {{ $index % 2 == 0 ? 'sticker-rotate-left' : 'sticker-rotate-right' }} hover:scale-105 transition-transform group cursor-pointer z-10">
            
            @if(!$user->is_active)
            <span class="absolute -top-4 -right-4 bg-error text-white font-black text-xs px-3 py-1 border-2 border-black rounded-full comic-shadow-sm z-20 rotate-12">SUSPENDED</span>
            @elseif($user->total_spent > 1000000)
            <span class="material-symbols-outlined absolute -top-5 -right-5 text-[#00ffff] text-5xl drop-shadow-md z-20" style="font-variation-settings: 'FILL' 1;">verified</span>
            @elseif($user->orders_count > 5)
            <span class="material-symbols-outlined absolute -top-5 -right-5 text-[#ff00ff] text-5xl drop-shadow-md z-20" style="font-variation-settings: 'FILL' 1;">star</span>
            @endif

            <!-- Profile Info -->
            <div class="flex items-center gap-4 mb-8">
                <div class="w-20 h-20 rounded-full border-4 border-black overflow-hidden bg-white shadow-md group-hover:rotate-6 transition-transform flex-shrink-0">
                    @if($user->avatar)
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-[#38bbef] flex items-center justify-center font-black text-2xl italic text-white border-black">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    @endif
                </div>
                <div>
                    <h3 class="font-headline-xl text-[28px] leading-tight text-black italic font-black uppercase line-clamp-1">{{ $user->name }}</h3>
                    <div class="flex items-center gap-2">
                        @if($user->isCashier())
                            <span class="bg-primary text-on-primary text-[10px] font-black uppercase px-2 py-0.5 rounded-full border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">Staff Kasir</span>
                        @endif
                        <p class="font-body-md text-black font-bold text-sm italic opacity-50 line-clamp-1">{{ $user->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Stats Rows (Pills) -->
            <div class="space-y-4">
                <div class="stat-pill">
                    <span class="font-bold italic text-black/60 text-sm">Total Spent:</span>
                    <div class="bg-[#fdd73b] px-3 py-0.5 rounded-full border-2 border-black font-black text-sm italic flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">payments</span> Rp {{ number_format($user->total_spent, 0, ',', '.') }}
                    </div>
                </div>
                <div class="stat-pill">
                    <span class="font-bold italic text-black/60 text-sm">Last Order:</span>
                    <span class="font-black text-sm text-black italic">{{ $user->last_order_date }}</span>
                </div>
                
                <form action="{{ route('admin.users.toggle_status', $user->id) }}" method="POST" class="mt-4 text-center">
                    @csrf
                    <button type="submit" class="w-full font-black text-sm uppercase px-4 py-2 border-2 border-black rounded-full comic-shadow-sm transition-all hover:translate-y-1 hover:shadow-none {{ $user->is_active ? 'bg-error-container text-error' : 'bg-primary text-white' }}">
                        {{ $user->is_active ? 'Suspend Account' : 'Activate Account' }}
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full p-20 text-center animate-fade-in">
            <div class="bg-white border-4 border-black rounded-[40px] comic-shadow p-12 inline-block rotate-1">
                <span class="material-symbols-outlined text-6xl text-primary mb-4 animate-bounce">group_off</span>
                <h3 class="font-headline-xl text-3xl italic font-black text-black">DATA TIDAK DITEMUKAN</h3>
                <p class="font-body-md text-on-surface-variant font-bold italic mt-2">There is no buyer matching your criteria.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection